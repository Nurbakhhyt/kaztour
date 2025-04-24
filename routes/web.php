<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BookingController;
use \App\Http\Controllers\TourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use \App\Http\Controllers\LocationController;
use Laravel\Fortify\Fortify;


//Route::get('/', function () {
//    return view('welcome');
//});
//
//
//Route::middleware(['auth'])->get('/home', function(){
//   return view('home');
//})->name('home');
//
////Route::get('/admin/users', [AdminController::class,'showUsers'])->name('admin.users');
//Route::resource('cities', CityController::class);
//Route::resource('locations', LocationController::class);
//Route::resource('tours',TourController::class);
//
//Route::middleware('auth')->group(function () {
//    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
//    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
//});

