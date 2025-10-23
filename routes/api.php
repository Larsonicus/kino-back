<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;

Route::apiResource('city', CityController::class);

Route::apiResource('seat', SeatController::class);

Route::apiResource('hall', HallController::class);

Route::apiResource('cinema', CinemaController::class);

Route::apiResource('movie', MovieController::class);

Route::apiResource('schedule', ScheduleController::class);
