<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TranscribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-act', [AuthController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/validasi-forgot-password/{token}', [AuthController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-act', [AuthController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');

Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect']);
Route::get('/auth-google-callback', [AuthController::class, 'google_callback']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| USER VERIFICATION
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'check_role:user'])->group(function () {

    Route::get('/verify', [VerificationController::class, 'index']);
    Route::post('/verify', [VerificationController::class, 'store']);
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show']);
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update']);
    Route::post('/verify/resend', [VerificationController::class, 'resend'])
        ->name('verify.resend');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'check_role:user', 'check_status'])->group(function () {
    Route::view('/user/dashboard', 'user.dashboard')->name('user.dashboard');
});

Route::middleware(['auth', 'check_role:admin,staff'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| USER MANAGEMENT (ADMIN + STAFF VIEW)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'check_role:admin,staff'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users.index');
});

Route::middleware(['auth', 'check_role:admin'])->group(function () {

    Route::get('/admin/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/admin/users', [UserController::class, 'store'])
        ->name('admin.users.store');

    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/admin/users/{id}', [UserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');
});


/*
|--------------------------------------------------------------------------
| TRANSCRIBE FEATURE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/upload', [TranscribeController::class, 'index'])->name('upload');
    Route::post('/upload', [TranscribeController::class, 'upload'])->name('upload.process');

    Route::post('/export-word', [TranscribeController::class, 'exportWord'])->name('export.word');
    Route::post('/export-pdf', [TranscribeController::class, 'exportPdf'])->name('export.pdf');
});


/*
|--------------------------------------------------------------------------
| HISTORY (CRUD - RESTFUL)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('history', HistoryController::class);
});
