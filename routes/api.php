<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RefreshTokenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResendVerificationEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', LoginController::class);
        Route::post('register', RegisterController::class);
        Route::post('reset-password', ResetPasswordController::class);
        Route::post('refresh', RefreshTokenController::class);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', LogoutController::class);

            Route::prefix('email')->group(function () {
                Route::post('verify', VerifyEmailController::class)->middleware('signed');
                Route::post('resend', ResendVerificationEmailController::class)->middleware('throttle:6,1');
            });
        });
    });
});
