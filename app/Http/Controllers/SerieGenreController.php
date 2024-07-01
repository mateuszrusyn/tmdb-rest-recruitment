<?php

namespace App\Http\Controllers;

use App\Models\SerieGenre;
use Illuminate\Http\JsonResponse;

class SerieGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $languageCode): JsonResponse
    {
        $serieGenres = SerieGenre::withTranslations($languageCode)->get();

        return response()->json($serieGenres);
    }
}
