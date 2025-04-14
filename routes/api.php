<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BookingController;
use \App\Http\Controllers\TourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use \App\Http\Controllers\LocationController;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//// Регистрация
//Route::post('/register', [RegisteredUserController::class, 'store']);
//
//// Логин
//Route::post('/login', [AuthenticatedSessionController::class, 'store'])
//    ->middleware('auth:sanctum');
//
//// Выход
//Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//    ->middleware('auth:sanctum');
//
//// Сброс пароля (отправка ссылки)
//Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
//
//// Сброс пароля (установка нового)
//Route::post('/reset-password', [NewPasswordController::class, 'store']);


//соңғы қолданылған routes
//Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
//Route::resource('cities', CityController::class);
//Route::resource('locations', LocationController::class);
//Route::resource('tours', TourController::class);
//
//Route::middleware('auth')->group(function () {
//    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
//    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
//});

//Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
//Route::post('/tours', [TourController::class, 'store'])->name('tours.store');
//Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');
//Route::get('/tours/{id}', [TourController::class, 'edit'])->name('tours.edit');
//Route::put('/tours/{id}', [TourController::class, 'update'])->name('tours.update');
//Route::delete('/tours/{id}', [TourController::class, 'destroy'])->name('tours.destroy');
//Route::post('/tours/{id}/purchase', [TourController::class, 'purchase'])->name('tours.purchase');






//
//use \App\Http\Controllers\TourController;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\CityController;
//use \App\Http\Controllers\LocationController;
//use App\Models\User;
//
///*
//|--------------------------------------------------------------------------
//| API Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register API routes for your application. These
//| routes are loaded by the RouteServiceProvider and all of them will
//| be assigned to the "api" middleware group. Make something great!
//|
//*/
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return User::all();
//});
//
//
//Route::get('/tours', [TourController::class, 'index']);
//Route::post('/tours', [TourController::class, 'store']);
//Route::get('/tours/{id}', [TourController::class, 'show']);
//Route::put('/tours/{id}', [TourController::class, 'update']);
//Route::delete('/tours/{id}', [TourController::class, 'destroy']);
//Route::post('/tours/{id}/purchase', [TourController::class, 'purchase']);
////Route::apiResource('cities', CityController::class);
////Route::apiResource('locations', LocationController::class);
//
