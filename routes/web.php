<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;

Route::resource('movies', MovieController::class);
Route::resource('schedules', ScheduleController::class);