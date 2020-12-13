<?php

use App\Admin\Bookings\Controllers\BookingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/bookings')->group(function () {
    Route::get('/', [BookingsController::class, 'index']);

    Route::get('/create', [BookingsController::class, 'create']);
    Route::post('/create', [BookingsController::class, 'store']);

    Route::get('/edit/{booking}', [BookingsController::class, 'edit']);
    Route::post('/edit/{booking}', [BookingsController::class, 'update']);
});
