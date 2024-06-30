<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $lang): JsonResponse
    {
        $languageId = Language::where('code', $lang)->first()->id;
        $movies = Movie::with(['translations' => function ($query) use ($languageId) {
            $query->where('language_id', $languageId);
        }])->get();

        return response()->json([
            $movies
        ]);
    }
}
