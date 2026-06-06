<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchlistController;

Route::get('/', fn() => redirect()->route('movies.index'));

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Public routes (tanpa login)
Route::resource('movies', MovieController::class)->only(['index', 'show']);
Route::resource('schedules', ScheduleController::class)->only(['index', 'show']);
Route::resource('studios', StudioController::class)->only(['index', 'show']);
Route::resource('seats', SeatController::class)->only(['index', 'show']);

// Customer routes (butuh login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/history', [UserController::class, 'bookingHistory'])->name('user.history');
    Route::get('/my-reviews', [UserController::class, 'myReviews'])->name('user.reviews');
    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist.index');
    Route::post('/watchlist/{movie}', [WatchlistController::class, 'store'])->name('watchlist.store');
    Route::delete('/watchlist/{watchlist}', [WatchlistController::class, 'destroy'])->name('watchlist.destroy');
});

// Admin routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('movies', MovieController::class)->except(['index', 'show']);
    Route::resource('schedules', ScheduleController::class)->except(['index', 'show']);
    Route::resource('studios', StudioController::class)->except(['show']);
    Route::resource('seats', SeatController::class)->except(['show']);
});