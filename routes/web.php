<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieGenreController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\SerieGenreController;
use Illuminate\Support\Facades\Route;

Route::get('{lang}/movies', [MovieController::class, 'index']);
Route::get('{lang}/series', [SerieController::class, 'index']);
Route::get('{lang}/movie/genres', [MovieGenreController::class, 'index']);
Route::get('{lang}/serie/genres', [SerieGenreController::class, 'index']);
