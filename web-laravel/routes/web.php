<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeteksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [DeteksiController::class, 'index']);
Route::post('/predict', [DeteksiController::class, 'predict']);