<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\JsonResponse;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $languageCode): JsonResponse
    {
        $series = Serie::withTranslations($languageCode)->get();

        return response()->json($series);
    }
}
