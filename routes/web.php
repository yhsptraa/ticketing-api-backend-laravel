<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;

Route::get('/', fn() => redirect()->route('login'));

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/history', [UserController::class, 'bookingHistory'])->name('user.history');
    Route::resource('movies', MovieController::class)->only(['index', 'show']);
    Route::resource('schedules', ScheduleController::class)->only(['index', 'show']);
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('movies', MovieController::class)->except(['index', 'show']);
    Route::resource('schedules', ScheduleController::class)->except(['index', 'show']);
});
