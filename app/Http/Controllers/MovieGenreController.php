<?php

namespace App\Http\Controllers;

use App\Models\MovieGenre;
use Illuminate\Http\JsonResponse;

class MovieGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $languageCode): JsonResponse
    {
        $movieGenres = MovieGenre::withTranslations($languageCode)->get();

        return response()->json($movieGenres);
    }
}
