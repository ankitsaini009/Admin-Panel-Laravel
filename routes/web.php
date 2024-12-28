<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\ProminentController;
use App\Http\Controllers\TargetedController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleBookingController;
use App\Http\Controllers\AllRideController;
use App\Http\Controllers\SOSController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\AllDriversController;
use App\Http\Controllers\CommisionController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\DriverDocumentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\UserReportController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::prefix('userreport')->group(function () {

        Route::get('/', [UserReportController::class, 'index'])->name('userreport.index');
        Route::post('/userreportstore', [UserReportController::class, 'userreportstore'])->name('userreport.store');
    });

    Route::prefix('administration_tools')->group(function () {

        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::any('/settingsstore', [SettingsController::class, 'settingsstore'])->name('settings.store');

        Route::any('/rideInclusions_remove/{value}/{id}/', [SettingsController::class, 'rideInclusions_remove'])->name('rideInclusions_remove');

        Route::any('/rulesRestrictions_remove/{value}/{id}/', [SettingsController::class, 'rulesRestrictions_remove'])->name('rulesRestrictions_remove');
        Route::any('/termsConditions_remove_remove/{value}/{id}/', [SettingsController::class, 'termsConditions_remove_remove'])->name('termsConditions_remove_remove');
    });


    Route::prefix('administration_tools')->group(function () {

        Route::get('/driver_document', [DriverDocumentController::class, 'index'])->name('drive_document.index');
        Route::get('/drive_documentcreate', [DriverDocumentController::class, 'drive_documentcreate'])->name('drive_document.create');
        Route::post('/drive_documentstore', [DriverDocumentController::class, 'drive_documentstore'])->name('drive_document.store');
        Route::get('/drive_documentedit/{id}', [DriverDocumentController::class, 'drive_documentedit'])->name('drive_document.edit');
        Route::get('/drive_documentstroy/{id}', [DriverDocumentController::class, 'drive_documentstroy'])->name('drive_document.destroy');
    });


    Route::prefix('administration_tools')->group(function () {

        Route::get('/tax', [TaxController::class, 'index'])->name('tax.index');
        Route::post('/taxstore', [TaxController::class, 'taxstore'])->name('tax.store');
    });

    Route::prefix('administration_tools')->group(function () {

        Route::get('/', [CommisionController::class, 'index'])->name('commission.index');
        Route::post('/commissionstore', [CommisionController::class, 'commissionstore'])->name('commission.store');
    });

    Route::prefix('all_drivers')->group(function () {

        Route::get('/', [AllDriversController::class, 'index'])->name('all_drivers.index');
        Route::get('/approved_drivers', [AllDriversController::class, 'approved_drivers'])->name('approved_drivers');
        Route::get('/pending_drivers', [AllDriversController::class, 'pending_drivers'])->name('pending_drivers');
        Route::get('/all_driverscreate', [AllDriversController::class, 'all_driverscreate'])->name('all_drivers.create');
        Route::post('/all_driversstore', [AllDriversController::class, 'all_driversstore'])->name('all_drivers.store');
        Route::get('/all_driversedit/{id}', [AllDriversController::class, 'all_driversedit'])->name('all_drivers.edit');
        Route::get('/all_driversdstroy/{id}', [AllDriversController::class, 'all_driversdstroy'])->name('all_drivers.destroy');
        Route::get('/drivers_approved', [AllDriversController::class, 'drivers_approved'])->name('drivers.approved');
        Route::get('/driver_detals/{id}', [AllDriversController::class, 'driver_detals'])->name('drivers.details');
    });


    Route::prefix('car_model')->group(function () {

        Route::get('/', [CarModelController::class, 'index'])->name('car_model.index');
        Route::get('/car_modelcreate', [CarModelController::class, 'car_modelcreate'])->name('car_model.create');
        Route::post('/car_modelstore', [CarModelController::class, 'car_modelstore'])->name('car_model.store');
        Route::get('/car_modeledit/{id}', [CarModelController::class, 'car_modeledit'])->name('car_model.edit');
        Route::get('/car_modedestroy/{id}', [CarModelController::class, 'car_modedestroy'])->name('car_model.destroy');
    });

    Route::prefix('brands')->group(function () {

        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/brand_typecreate', [BrandController::class, 'brandcreate'])->name('brand.create');
        Route::post('/brand_typestore', [BrandController::class, 'brandstore'])->name('brand.store');
        Route::get('/brand_typeedit/{id}', [BrandController::class, 'brandedit'])->name('brand.edit');
        Route::get('/brand_typedestroy/{id}', [BrandController::class, 'brandstroy'])->name('brand.destroy');
    });

    Route::prefix('vehicle_type')->group(function () {

        Route::get('/', [VehicleTypeController::class, 'index'])->name('vehicle_type.index');
        Route::get('/vehicle_typecreate', [VehicleTypeController::class, 'vehicle_typecreate'])->name('vehicle_type.create');
        Route::post('/vehicle_typestore', [VehicleTypeController::class, 'vehicle_typestore'])->name('vehicle_type.store');
        Route::get('/vehicle_typeedit/{id}', [VehicleTypeController::class, 'vehicle_typeedit'])->name('vehicle_type.edit');
        Route::get('/vehicle_typedestroy/{id}', [VehicleTypeController::class, 'vehicle_typedestroy'])->name('vehicle_type.destroy');
    });


    Route::prefix('complaints')->group(function () {

        Route::get('/', [ComplaintsController::class, 'index'])->name('complaints.index');
        Route::get('/complaints_destroy/{id}', [ComplaintsController::class, 'complaints_destroy'])->name('complaints.destroy');
    });

    Route::prefix('sos')->group(function () {

        Route::get('/', [SOSController::class, 'index'])->name('sos.index');
        Route::get('/sos_destroy/{id}', [SOSController::class, 'sos_destroy'])->name('sos.destroy');
    });

    Route::prefix('all_rides')->group(function () {

        Route::get('/', [AllRideController::class, 'index'])->name('allRide.index');
        Route::get('/allRide_destroy/{id}', [AllRideController::class, 'allRide_destroy'])->name('allRide.destroy');
    });

    Route::prefix('vehicle_booking')->group(function () {

        Route::get('/', [VehicleBookingController::class, 'index'])->name('vehicle_booking.index');
        Route::get('/vehicle_booking_destroy/{id}', [VehicleBookingController::class, 'vehicle_booking_destroy'])->name('vehicle_booking.destroy');
    });

    Route::prefix('vehicle-rental-type')->group(function () {

        Route::get('/', [VehicleController::class, 'index'])->name('vehicle.index');
        Route::get('/vehiclecreate', [VehicleController::class, 'vehiclecreate'])->name('vehicle.create');
        Route::post('/vehiclestore', [VehicleController::class, 'vehiclestore'])->name('vehicle.store');
        Route::get('/vehicleedit/{id}', [VehicleController::class, 'vehicleedit'])->name('vehicle.edit');
        Route::get('/vehicledestroy/{id}', [VehicleController::class, 'vehicleestroy'])->name('vehicle.destroy');
    });


    Route::prefix('user')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/usercreate', [UserController::class, 'usercreate'])->name('user.create');
        Route::post('/userstore', [UserController::class, 'userstore'])->name('user.store');
        Route::get('/useredit/{id}', [UserController::class, 'useredit'])->name('user.edit');
        Route::get('/userdestroy/{id}', [UserController::class, 'userdestroy'])->name('user.destroy');
    });

    Route::prefix('coupons')->group(function () {

        Route::get('/', [CouponsController::class, 'index'])->name('coupons.index');
        Route::get('/couponcreate', [CouponsController::class, 'couponcreate'])->name('coupons.create');
        Route::post('/couponstore', [CouponsController::class, 'couponstore'])->name('coupons.store');
        Route::get('/couponedit/{id}', [CouponsController::class, 'couponedit'])->name('coupons.edit');
        Route::get('/coupondestroy/{id}', [CouponsController::class, 'coupondestroy'])->name('coupons.destroy');
    });

    Route::prefix('ride_incentives_prominent')->group(function () {

        Route::get('/', [ProminentController::class, 'index'])->name('prominent.index');
        Route::get('/prominentcreate', [ProminentController::class, 'prominentcreate'])->name('prominent.create');
        Route::post('/prominentstore', [ProminentController::class, 'prominentstore'])->name('prominent.store');
        Route::get('/prominentedit/{id}', [ProminentController::class, 'prominentedit'])->name('prominent.edit');
        Route::get('/prominentdestroy/{id}', [ProminentController::class, 'prominentdestroy'])->name('prominent.destroy');
        Route::get('ride/delete/{id}', [ProminentController::class, 'delete_ride'])->name('ride.delete');
    });

    Route::prefix('ride_incentives_targeted')->group(function () {

        Route::get('/', [TargetedController::class, 'index'])->name('targeted.index');
        Route::get('/targetedcreate', [TargetedController::class, 'targetedcreate'])->name('targeted.create');
        Route::post('/targetedstore', [TargetedController::class, 'targetedstore'])->name('targeted.store');
        Route::get('/targetededit/{id}', [TargetedController::class, 'targetededit'])->name('targeted.edit');
        Route::get('/targeteddestroy/{id}', [TargetedController::class, 'targeteddestroy'])->name('targeted.destroy');
        Route::get('targeted/delete/{id}', [TargetedController::class, 'delete_targeted'])->name('targeted.delete');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
