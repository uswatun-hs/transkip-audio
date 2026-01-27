<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranscribeController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/transcribe', [TranscribeController::class, 'upload'])
    ->name('transcribe');
Route::get('/', [TranscribeController::class, 'index']);



