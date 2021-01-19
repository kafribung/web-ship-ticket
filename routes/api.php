<?php

use App\Http\Controllers\API\Auth\{LoginController, LogoutController};
use App\Http\Controllers\API\Dash\{AdminConrtoller, BookingController, CustomerController, DashboardController, DeleteBookingController, ScheduleController, ServiceController, StatusController, VehicleController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('dashboard', DashboardController::class);
    // Admin
    Route::get('admin', [AdminConrtoller::class, 'index']);
    Route::post('admin', [AdminConrtoller::class, 'store']);
    Route::get('admin/{user:email}', [AdminConrtoller::class, 'show']);
    Route::patch('admin/{user:email}', [AdminConrtoller::class, 'update']);
    Route::delete('admin/{user:email}', [AdminConrtoller::class, 'destroy']);

    // Jadwal
    Route::get('schedule', [ScheduleController::class, 'index']);
    Route::post('schedule', [ScheduleController::class, 'store']);
    Route::get('schedule/{id}', [ScheduleController::class, 'show']);
    Route::patch('schedule/{id}', [ScheduleController::class, 'update']);
    Route::delete('schedule/{id}', [ScheduleController::class, 'destroy']);

    // Layanan
    Route::get('service', ServiceController::class);

    // Golongan Kendaraan
    Route::get('vehicle', VehicleController::class);

    // Customer
    Route::get('booking', [BookingController::class, 'index']);
    Route::post('booking', [BookingController::class, 'store']);
    Route::delete('booking/{customer:id}', [BookingController::class, 'destroy']);

    // Customer
    Route::get('customer', CustomerController::class);

    // Statsu customer
    Route::patch('status/{customer:id}', StatusController::class);

    // Delete Booking Otomatis
    Route::get('delete-booking', DeleteBookingController::class);

    Route::post('logout', LogoutController::class);
});
Route::post('login', LoginController::class);
