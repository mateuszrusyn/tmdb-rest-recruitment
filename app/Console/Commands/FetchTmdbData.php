<?php

namespace App\Console\Commands;

use App\Enums\LanguageType;
use App\Enums\TmdbDataType;
use App\Models\Language;
use App\Services\TmdbService;
use Illuminate\Console\Command;

class FetchTmdbData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-tmdb-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Movies, Series, Genres data from TMDB API';

    private TmdbService $tmdbService;

    protected int $limit = 50;

    /**
     * Execute the console command.
     */
    public function handle(TmdbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
        $this->generateLanguages();
        $languages = Language::all();

        foreach ($languages as $language) {
            $this->newLine();
            $this->info("<options=bold;fg=blue>Fetching data from TMDB for language: {$language->code}</>");

            $series = $this->fetchSeries($language);
            $movies = $this->fetchMovies($language);
            $seriesGenres = $this->fetchSeriesGenres($language);
            $moviesGenres = $this->fetchMoviesGenres($language);

            $this->info("Fetched: " . count($movies) . ' movies');
            $this->info("Fetched: " . count($series) . ' series');
            $this->info("Fetched: " . count($seriesGenres) . ' serie genres');
            $this->info("Fetched: " . count($moviesGenres) . ' movie genres');

            $this->tmdbService->storeMovieGenres($moviesGenres, $language);
            $this->tmdbService->storeMovies($movies, $language);
            $this->tmdbService->storeSerieGenres($seriesGenres, $language);
            $this->tmdbService->storeSeries($series, $language);
        }
    }

    private function fetchSeries(Language $language): array
    {
        return $this->tmdbService->getPopular(TmdbDataType::SERIE, $language, $this->limit);
    }

    private function fetchMovies(Language $language): array
    {
        return $this->tmdbService->getPopular(TmdbDataType::MOVIE, $language, $this->limit);
    }

    private function fetchMoviesGenres(Language $language): array
    {
        return $this->tmdbService->getGenres(TmdbDataType::MOVIE, $language);
    }

    private function fetchSeriesGenres(Language $language): array
    {
        return $this->tmdbService->getGenres(TmdbDataType::SERIE, $language);
    }

    private function generateLanguages(): void
    {
        foreach (LanguageType::cases() as $language) {
            Language::updateOrCreate(['code' => $language->value]);
        }
    }
}
