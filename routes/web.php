<?php

use App\Http\Controllers\AttendanceLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnvReadingController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\FuelLogController;
use App\Http\Controllers\MaintenanceJobController;
use App\Http\Controllers\ProductionLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceItemController;
use App\Http\Controllers\SafetyIncidentController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('sites', SiteController::class);
    Route::resource('equipment', EquipmentController::class);
    Route::resource('resources', ResourceItemController::class);
    Route::resource('stock-movements', StockMovementController::class);
    Route::resource('production-logs', ProductionLogController::class);
    Route::resource('maintenance', MaintenanceJobController::class);
    Route::resource('safety-incidents', SafetyIncidentController::class);
    Route::resource('env-readings', EnvReadingController::class);
    Route::resource('fuel-logs', FuelLogController::class);
    Route::resource('resource_items', ResourceItemController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('attendance_logs', AttendanceLogController::class);
});

require __DIR__ . '/auth.php';
