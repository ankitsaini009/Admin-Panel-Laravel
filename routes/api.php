<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use APP\Http\Controllers\Api\TestApiController;
use PhpParser\Builder\Function_;

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

// Add Api Rate Limit

// Route::middleware('throttle:2,1')->group(function () {};

Route::middleware('api.rate.limiter')->group(function () {

    Route::get('/Complaints', [App\Http\Controllers\Api\TestApiController::class, 'index'])->name('Complaints.api');
    Route::get('/Complaints/delete/{id}', [App\Http\Controllers\Api\TestApiController::class, 'Complaints_delete'])->name('Complaints.delete');
    Route::post('/Complaints', [App\Http\Controllers\Api\TestApiController::class, 'storedata'])->name('store.api');
    Route::post('/Complaints-update/{id}', [App\Http\Controllers\Api\TestApiController::class, 'update_complaints'])->name('update_complaints.api');

    Route::prefix('all_rides/')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\AllRideApiControler::class, 'index'])->name('index.Ride');
        Route::post('Creat-ride', [\App\Http\Controllers\Api\AllRideApiControler::class, 'StoreRide'])->name('Store.Ride');

        Route::post('Update-ride/{id}', [\App\Http\Controllers\Api\AllRideApiControler::class, 'UpdateRide'])->name('Update.Ride');

        Route::get('Delete-ride/{id}', [\App\Http\Controllers\Api\AllRideApiControler::class, 'DeleteRide'])->name('Delete.Ride');
    });

    Route::prefix('SOS/')->group(function () {

        Route::get('/', [\App\Http\Controllers\Api\SOSApiControler::class, 'index'])->name('index.Ride');
        Route::post('Store-SOS', [\App\Http\Controllers\Api\SOSApiControler::class, 'StoreSOS'])->name('Store.Ride');

        Route::post('Update-SOS/{id}', [\App\Http\Controllers\Api\SOSApiControler::class, 'UpdateSOS'])->name('Update.Ride');

        Route::get('Delete-SOS/{id}', [\App\Http\Controllers\Api\SOSApiControler::class, 'DeleteSOS'])->name('Delete.Ride');
    });

    Route::prefix('vehicle_booking/')->group(function () {

        Route::get('/', [\App\Http\Controllers\Api\VehicleBookingController::class, 'index'])->name('index.Ride');
        Route::post('Store-Outstation_vehicle_booking', [\App\Http\Controllers\Api\VehicleBookingController::class, 'Store'])->name('Store');

        Route::post('Update-Outstation_vehicle_booking/{id}', [\App\Http\Controllers\Api\VehicleBookingController::class, 'Update'])->name('Update');

        Route::get('Delete-Outstation_vehicle_booking/{id}', [\App\Http\Controllers\Api\VehicleBookingController::class, 'Delete'])->name('Delete');
    });

    Route::prefix('users/')->group(function () {

        Route::get('/', [\App\Http\Controllers\Api\UserApiController::class, 'index'])->name('index.users');
        Route::post('Store-users', [\App\Http\Controllers\Api\UserApiController::class, 'Storeusers'])->name('Store.users');

        Route::post('Update-users/{id}', [\App\Http\Controllers\Api\UserApiController::class, 'Updateusers'])->name('Update.users');

        Route::get('Delete-users/{id}', [\App\Http\Controllers\Api\UserApiController::class, 'Deleteusers'])->name('Delete.users');
    });
});
