<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('login', LoginController::class)->only('store');
    Route::apiResource('register', RegisterController::class)->only('store');

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('company', CompanyController::class);
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('billings', BillingController::class);
        Route::apiResource('payments', PaymentController::class);
        Route::get('customers/{customer}/billings', [BillingController::class,'customerBillings']);
    });
});
