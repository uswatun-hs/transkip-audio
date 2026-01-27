<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranscribeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [TranscribeController::class, 'index']);
Route::post('/upload', [TranscribeController::class, 'upload']);
Route::get('/transcribe/result/{taskId}', [TranscribeController::class, 'result']);
Route::post('/export-word', [TranscribeController::class, 'exportWord']);
Route::post('/export-pdf', [TranscribeController::class, 'exportPdf']);



