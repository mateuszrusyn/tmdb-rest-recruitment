<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $languageCode): JsonResponse
    {
        $movies = Movie::withTranslations($languageCode)->get();

        return response()->json($movies);
    }
}
