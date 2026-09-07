<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\GuestApiController;
use App\Http\Controllers\Api\RoomApiController;
use App\Http\Controllers\Api\ReservationApiController;

Route::post('/auth/register', [AuthApiController::class, 'register']);
Route::post('/auth/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth endpoints
    Route::post('/auth/logout', [AuthApiController::class, 'logout']);
    Route::get('/auth/me', [AuthApiController::class, 'me']);

    // Guests API
    Route::apiResource('guests', GuestApiController::class);

    // Rooms API
    Route::apiResource('rooms', RoomApiController::class);

    // Reservations API
    Route::apiResource('reservations', ReservationApiController::class);
});
