<?php

use Illuminate\Support\Facades\Route;

// Auth Controller
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login_view'])->name('login.view');
Route::post('/login', [AuthController::class, 'login_attempt'])->name('login.attempt');
