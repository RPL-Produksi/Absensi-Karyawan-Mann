<?php

use App\Http\Controllers\Frontend\v1\AuthController as FrontendAuthController;
use App\Http\Controllers\Backend\v1\AuthController as BackendAuthController;
use App\Http\Controllers\Frontend\v1\HomeController;
use Illuminate\Support\Facades\Route;

// Auth
Route::group(['prefix' => 'auth'], function () {
    Route::group(['controller' => FrontendAuthController::class], function () {
        Route::get('/login', 'login')->name('fe.login');
        Route::get('/register', 'register')->name('fe.register');
    });
    Route::group(['controller' => BackendAuthController::class], function () {
        Route::post('/login', 'login')->name('be.login');
        Route::post('/register', 'register')->name('be.register');
        Route::post('/logout', 'logout')->name('be.logout');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});