<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranscribeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('wlcm');
});

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth', 'check_role:admin,staff']], function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['auth', 'check_role:user']], function () {
Route::get('/user', fn () => 'halama user');
});

Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
Route::get('/user', fn () => 'halama user');
});

Route::get('/logout', [AuthController::class, 'logout']);



Route::get('/', [WelcomeController::class, 'welcome']);
// Route::get('/login', [LoginController::class, 'index']);
Route::get('/upload', [TranscribeController::class, 'index']);
Route::post('/upload', [TranscribeController::class, 'upload']);
Route::get('/transcribe/result/{taskId}', [TranscribeController::class, 'result']);
Route::post('/export-word', [TranscribeController::class, 'exportWord']);
Route::post('/export-pdf', [TranscribeController::class, 'exportPdf']);



