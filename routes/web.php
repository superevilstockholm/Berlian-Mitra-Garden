<?php

use Illuminate\Support\Facades\Route;

// Auth Controller
use App\Http\Controllers\AuthController;

Route::get('/', fn () => view('pages.index'))->name('index');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login_view'])->name('login.view');
    Route::post('/login', [AuthController::class, 'login_attempt'])->name('login.attempt');
});

// Protected
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout_attempt'])->name('logout.attempt');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', fn () => view('pages.dashboard.index'))->name('index');
    });
});
