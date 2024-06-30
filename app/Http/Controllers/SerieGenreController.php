<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\SerieGenre;
use Illuminate\Http\JsonResponse;

class SerieGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $lang): JsonResponse
    {
        $languageId = Language::where('code', $lang)->first()->id;
        $serieGenres = SerieGenre::with(['translations' => function ($query) use ($languageId) {
            $query->where('language_id', $languageId);
        }])->get();

        return response()->json([$serieGenres]);
    }
}
