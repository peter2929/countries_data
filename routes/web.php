<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountriesController;

Route::get('/', [CountriesController::class, 'index']);
Route::get('/import', [CountriesController::class, 'import']);
Route::delete('/delete', [CountriesController::class, 'delete']);
