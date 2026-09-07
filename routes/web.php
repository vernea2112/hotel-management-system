<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Guests
    Route::resource('guests', GuestController::class);

    // Rooms
    Route::resource('rooms', RoomController::class);

    // Reservations
    Route::resource('reservations', ReservationController::class);
    Route::post('/reservations/{reservation}/check-in', [ReservationController::class, 'checkIn'])
        ->name('reservations.checkIn');
    Route::post('/reservations/{reservation}/check-out', [ReservationController::class, 'checkOut'])
        ->name('reservations.checkOut');

    // Payments
    Route::resource('payments', PaymentController::class, ['only' => ['index']]);
    Route::post('/payments/process', [PaymentController::class, 'processPayment'])
        ->name('payments.process');

    // Reports
    Route::get('/reports/occupancy', [ReportController::class, 'occupancyReport'])
        ->name('reports.occupancy');
    Route::get('/reports/revenue', [ReportController::class, 'revenueReport'])
        ->name('reports.revenue');
    Route::get('/reports/guests', [ReportController::class, 'guestReport'])
        ->name('reports.guest');
});
