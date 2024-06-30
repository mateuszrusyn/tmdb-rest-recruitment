<?php

namespace App\Console\Commands;

use App\Enums\LanguageType;
use App\Enums\PopularType;
use App\Enums\TmdbDataType;
use App\Models\Language;
use App\Models\MovieGenre;
use App\Models\Serie;
use App\Models\SerieGenre;
use App\Services\TmdbService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;

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
    protected $description = 'Command description';

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
            $series = $this->fetchSeries($language);
            $movies = $this->fetchMovies($language);
            $seriesGenres = $this->fetchSeriesGenres($language);
            $moviesGenres = $this->fetchMoviesGenres($language);

            $this->tmdbService->storeMovieGenres($moviesGenres, $language);
            $this->tmdbService->storeMovies($movies, $language);
            $this->tmdbService->storeSerieGenres($seriesGenres, $language);
            $this->tmdbService->storeSeries($series, $language);
        }
    }

    private function fetchSeries(Language $language): array
    {
        return $this->tmdbService->getPopular(TmdbDataType::SERIE, $language, $this->limit,);
    }

    private function fetchMovies(Language $language): array
    {
        return $this->tmdbService->getPopular(TmdbDataType::MOVIE, $language, $this->limit,);
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
