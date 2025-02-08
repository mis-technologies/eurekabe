<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\EmailController;
use Modules\Auth\Http\Controllers\Api\LoginController;
use Modules\Auth\Http\Controllers\Api\PasswordController;
use Modules\Auth\Http\Controllers\Api\RegisterController;
use Modules\Auth\Http\Controllers\Api\SocialAuthController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/


Route::namespace('Api')->prefix('v1')->group(function () {

    // GUEST
    Route::prefix('auth')->group(function () {
        Route::post('login', [LoginController::class, 'login']);
        Route::post('register', [RegisterController::class, 'register']);
        Route::post('password/forgot', [PasswordController::class, 'forgetPassword']);
        Route::post('password/reset', [PasswordController::class, 'resetPassword']);
        Route::get('email/verify/{id}', [EmailController::class, 'verifyLink'])->name('email.verifylink');
        Route::post('email/verify', [EmailController::class, 'verifyCode'])->name('email.verifycode');
        Route::post('email/resend-code', [EmailController::class, 'resendCode'])->name('email.resendcode');
        Route::post('social/login-google', [SocialAuthController::class, 'loginSocialUserWithGoogleToken']);
        // Route::post('phone/verify', 'PhoneVerificationController@verify')->name('verify.phone');

    });

});

