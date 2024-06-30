<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Serie;
use Illuminate\Http\JsonResponse;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $lang): JsonResponse
    {
        $languageId = Language::where('code', $lang)->first()->id;
        $series = Serie::with(['translations' => function ($query) use ($languageId) {
            $query->where('language_id', $languageId);
        }])->get();

        return response()->json([$series]);
    }
}
