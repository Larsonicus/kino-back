<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\CinemaController;


Route::apiResource('cities', CityController::class);

Route::apiResource('seats', SeatController::class);

Route::apiResource('halls', HallController::class);

Route::apiResource('cinemas', CinemaController::class);
