<?php

use App\Http\Controllers\Admin\AdminController;
use \App\Http\Controllers\TourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use \App\Http\Controllers\LocationController;
use Laravel\Fortify\Fortify;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->get('/home', function(){
   return view('home');
})->name('home');

Route::get('/admin/users', [AdminController::class,'showUsers'])->name('admin.users');
Route::resource('cities', CityController::class);
Route::resource('locations', LocationController::class);
Route::resource('tours',TourController::class);

//Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
//Route::post('/tours', [TourController::class, 'store'])->name('tours.store');
//Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');
//Route::get('/tours/{id}', [TourController::class, 'edit'])->name('tours.edit');
//Route::put('/tours/{id}', [TourController::class, 'update'])->name('tours.update');
//Route::delete('/tours/{id}', [TourController::class, 'destroy'])->name('tours.destroy');
Route::post('/tours/{id}/purchase', [TourController::class, 'purchase'])->name('tours.purchase');
