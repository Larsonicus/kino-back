<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\HallController;

Route::apiResource('cities', CityController::class);

Route::apiResource('seats', SeatController::class);

Route::apiResource('halls', HallController::class);
