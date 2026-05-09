<?php

use Illuminate\Support\Facades\Route;

// Auth Controller
use App\Http\Controllers\AuthController;

// Master Data Controllers
use App\Http\Controllers\MasterData\UserController;
use App\Http\Controllers\MasterData\VisionController;
use App\Http\Controllers\MasterData\MissionController;
use App\Http\Controllers\MasterData\ContactController;
use App\Http\Controllers\MasterData\OfferingController;
use App\Http\Controllers\MasterData\CompanyValueController;

// Setting Controllers
use App\Http\Controllers\Setting\ActivityLogController;

Route::get('/', fn () => view('pages.index'))->name('index');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login_view'])->name('login.view');
    Route::post('/login', [AuthController::class, 'login_attempt'])->name('login.attempt');
});

// Protected
Route::middleware(['auth', 'activity-log'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout_attempt'])->name('logout.attempt');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', fn () => view('pages.dashboard.index'))->name('index');

        Route::prefix('master-data')->name('master-data.')->group(function () {
            Route::resource('users', UserController::class)->parameters([
                'users' => 'user',
            ]);
            Route::resource('visions', VisionController::class)->parameters([
                'visions' => 'vision',
            ]);
            Route::resource('missions', MissionController::class)->parameters([
                'missions' => 'mission',
            ]);
            Route::resource('company-values', CompanyValueController::class)->parameters([
                'company-values' => 'companyValue',
            ]);
            Route::resource('offerings', OfferingController::class)->parameters([
                'offerings' => 'offering',
            ]);
            Route::resource('contacts', ContactController::class)->parameters([
                'contacts' => 'contact',
            ]);
        });

        Route::prefix('setting')->name('setting.')->group(function () {
            Route::resource('activity-logs', ActivityLogController::class)->parameters([
                'activity-logs' => 'activityLog',
            ])->only(['index', 'show']);
        });
    });
});
