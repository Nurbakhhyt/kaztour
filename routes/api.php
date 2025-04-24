<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TourController;
use App\Models\City;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
// routes/api.php


Route::post('/login', [AuthController::class, 'login']);


Route::post('/register-view', function () {
    $cities = City::all();
    return response()->json([
        'message' => 'Register page',
        'cities' => $cities
    ]);
});


// Выход (Только для авторизованных)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

// Сброс пароля
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('/reset-password', [NewPasswordController::class, 'store']);

// Общие маршруты
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
Route::resource('cities', CityController::class);
Route::resource('locations', LocationController::class);
Route::resource('tours', TourController::class);

// Только для авторизованных пользователей
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

// Получить текущего авторизованного пользователя
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
