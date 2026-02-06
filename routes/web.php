<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranscribeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('wlcm');
});

Route::get('/login', fn () => view('auth.login'))->name('login');

Route::get('/', [WelcomeController::class, 'welcome']);
// Route::get('/login', [LoginController::class, 'index']);
Route::get('/upload', [TranscribeController::class, 'index']);
Route::post('/upload', [TranscribeController::class, 'upload']);
Route::get('/transcribe/result/{taskId}', [TranscribeController::class, 'result']);
Route::post('/export-word', [TranscribeController::class, 'exportWord']);
Route::post('/export-pdf', [TranscribeController::class, 'exportPdf']);



