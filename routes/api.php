<?php

use App\Http\Controllers\TourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use \App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tours', [TourController::class, 'index']);
Route::post('/tours', [TourController::class, 'store']);
Route::get('/tours/{id}', [TourController::class, 'show']);
Route::put('/tours/{id}', [TourController::class, 'update']);
Route::delete('/tours/{id}', [TourController::class, 'destroy']);
Route::post('/tours/{id}/purchase', [TourController::class, 'purchase']);
Route::apiResource('cities', CityController::class);
Route::apiResource('locations', LocationController::class);
