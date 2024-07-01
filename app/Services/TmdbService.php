<?php

namespace App\Services;

use App\Enums\TmdbDataType;
use App\Models\Language;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\MovieGenreTranslation;
use App\Models\MovieTranslation;
use App\Models\Serie;
use App\Models\SerieGenre;
use App\Models\SerieGenreTranslation;
use App\Models\SerieTranslation;
use Illuminate\Support\Facades\Http;

class TmdbService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected int $apiPageLimit;

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
        $this->baseUrl = 'https://api.themoviedb.org/3';
        $this->apiPageLimit = 20;
    }

    public function getPopular(TmdbDataType $type, Language $language, int $limit = 50): array
    {
        $results = [];
        $pageLimit = ceil($limit / $this->apiPageLimit);


        for ($page = 1; $page <= $pageLimit; $page++) {
            $response = Http::get("{$this->baseUrl}/{$type->value}/popular", [
                'api_key' => $this->apiKey,
                'language' => $language->code,
                'page' => $page,
            ]);
            $results = array_merge($results, $response['results']);
        }

        return array_slice($results, 0, 50);
    }

    public function getGenres(TmdbDataType $type, Language $language): array
    {
        $response = Http::get("{$this->baseUrl}/genre/{$type->value}/list", [
            'api_key' => $this->apiKey,
            'language' => $language->code,
        ]);

        return $response['genres'];
    }

    public function storeMovieGenres(array $genres, Language $language): void
    {
        foreach ($genres as $genre) {
            $movieGenre = MovieGenre::updateOrCreate([
                'tmdb_id' => $genre['id'],
            ]);

            MovieGenreTranslation::updateOrCreate([
                'movie_genre_id' => $movieGenre->id,
                'name' => $genre['name'],
                'language_id' => $language->id,
            ]);
        }
    }

    public function storeSerieGenres(array $genres, Language $language): void
    {
        foreach ($genres as $genre) {
            $serieGenre = SerieGenre::updateOrCreate([
                'tmdb_id' => $genre['id'],
            ]);

            SerieGenreTranslation::updateOrCreate([
                'serie_genre_id' => $serieGenre->id,
                'name' => $genre['name'],
                'language_id' => $language->id,
            ]);
        }
    }

    public function storeMovies(array $movies, Language $language): void
    {
        foreach ($movies as $movie) {
            $createdMovie = Movie::updateOrCreate([
                'tmdb_id' => $movie['id'],
            ],
                [
                    'release_date' => $movie['release_date'],
                    'vote_average' => $movie['vote_average'],
                ]);
            $genresIds = MovieGenre::whereIn('tmdb_id', array_values($movie['genre_ids']))->pluck('id')->toArray();
            $createdMovie->genres()->sync($genresIds);

            MovieTranslation::updateOrCreate([
                'movie_id' => $createdMovie->id,
                'title' => $movie['title'],
                'overview' => $movie['overview'],
                'language_id' => $language->id,
            ]);
        }
    }

    public function storeSeries(array $series, Language $language): void
    {
        foreach ($series as $serie) {
            $createdSerie = Serie::updateOrCreate([
                'tmdb_id' => $serie['id'],
            ],
                [
                    'first_air_date' => $serie['first_air_date'],
                    'vote_average' => $serie['vote_average'],
                ]);
            $genresIds = SerieGenre::whereIn('tmdb_id', array_values($serie['genre_ids']))->pluck('id')->toArray();
            $createdSerie->genres()->sync($genresIds);

            SerieTranslation::updateOrCreate([
                'serie_id' => $createdSerie->id,
                'name' => $serie['name'],
                'overview' => $serie['overview'],
                'language_id' => $language->id,
            ]);
        }
    }
}
