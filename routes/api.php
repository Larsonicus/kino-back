<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CinemaScheduleController;
use App\Http\Controllers\HallScheduleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\OrderController;

Route::get('/calendar', [CalendarController::class, 'index']);

Route::get('/movie', [MovieController::class, 'index']);
Route::get('/movie/{id}', [MovieController::class, 'show']);

Route::get('/cinema', [CinemaController::class, 'index']);
Route::get('/cinema/{id}', [CinemaController::class, 'show']);

Route::get('/hall', [HallController::class, 'index']);
Route::get('/hall/{id}', [HallController::class, 'show']);

Route::get('/city', [CityController::class, 'index']);
Route::get('/city/{id}', [CityController::class, 'show']);

Route::get('/schedule', [ScheduleController::class, 'index']);
Route::get('/schedule/{id}', [ScheduleController::class, 'show']);

Route::get('/cinema-schedule', [CinemaScheduleController::class, 'index']);
Route::get('/cinema-schedule/{id}', [CinemaScheduleController::class, 'show']);

Route::get('/hall-schedule', [HallScheduleController::class, 'index']);
Route::get('hall-schedule/{id}', [HallScheduleController::class, 'show']);

Route::get('/session', [SessionController::class, 'index']);
Route::get('/session/{id}', [SessionController::class, 'show']);

Route::get('/seat', [SeatController::class, 'index']);
Route::get('/seat/{id}', [SeatController::class, 'show']);

Route::middleware(['auth:api', 'permission:manage movie'])->group(function () {
    Route::post('/movie', [MovieController::class, 'store']);
    Route::patch('/movie/{id}', [MovieController::class, 'update']);
    Route::delete('/movie/{id}', [MovieController::class, 'destroy']);
});

Route::middleware(['auth:api', 'permission:manage cinema'])->group(function () {
    Route::post('/cinema', [CinemaController::class, 'store']);
    Route::patch('/cinema/{id}', [CinemaController::class, 'update']);
    Route::delete('/cinema/{id}', [CinemaController::class, 'destroy']);
});

Route::middleware(['auth:api', 'permission:manage hall'])->group(function () {
    Route::post('/hall', [HallController::class, 'store']);
    Route::patch('/hall/{id}', [HallController::class, 'update']);
    Route::delete('/hall/{id}', [HallController::class, 'destroy']);
});

Route::middleware(['auth:api', 'permission:manage city'])->group(function () {
    Route::post('/city', [CityController::class, 'store']);
    Route::patch('/city/{id}', [CityController::class, 'update']);
    Route::delete('/city/{id}', [CityController::class, 'destroy']);
});

Route::middleware(['auth:api', 'permission:manage schedule'])->group(function () {
    Route::post('/cinema-schedule', [CinemaScheduleController::class, 'store']);
    Route::patch('/cinema-schedule/{id}', [CinemaScheduleController::class, 'update']);
    Route::delete('/cinema-schedule/{id}', [CinemaScheduleController::class, 'destroy']);

    Route::post('/hall-schedule', [HallScheduleController::class, 'store']);
    Route::patch('/hall-schedule/{id}', [HallScheduleController::class, 'update']);
    Route::delete('/hall-schedule/{id}', [HallScheduleController::class, 'destroy']);

    Route::post('/session', [SessionController::class, 'store']);
    Route::patch('/session/{id}', [SessionController::class, 'update']);
    Route::delete('/session/{id}', [SessionController::class, 'destroy']);

    Route::post('/seat', [SeatController::class, 'store']);
    Route::patch('/seat/{id}', [SeatController::class, 'update']);
    Route::delete('/seat/{id}', [SeatController::class, 'destroy']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/order', [OrderController::class, 'index']);
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});
