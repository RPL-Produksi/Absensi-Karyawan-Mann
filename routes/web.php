<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserAttendanceController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'indexLogin')->name('index.login');
        Route::get('register', 'indexRegister')->name('index.register');
        Route::post('login', 'login')->name('auth.login');
        Route::post('register', 'register')->name('auth.register');
        Route::post('logout', 'logout')->name('auth.logout');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminDashboardController::class)->group(function () {
            Route::get('dashboard', 'index')->name('admin.dashboard');
        });
    });
    Route::controller(UserDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('user.dashboard');
    });
    Route::controller(UserAttendanceController::class)->group(function () {
        Route::post('attendance/check-in', 'markCheckIn')->name('check.in');
        Route::post('attendance/check-out', 'markCheckOut')->name('check.out');
    });
});
