<?php

use App\Http\Controllers\ApikeyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;

Route::get('/', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/register', [AuthenticationController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthenticationController::class, 'processRegister'])->name('register.process');

    Route::get('/dashboard', [DashboardController::class, 'render'])->name('home');
    Route::resource('apikeys', ApikeyController::class);
});
