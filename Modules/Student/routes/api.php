<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\Api\StudentController;

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

  
    // Account
    Route::middleware('auth:sanctum')->prefix('students')->group(function () {
        Route::post('account', [StudentController::class, 'createAccount']);
        Route::get('me', [StudentController::class, 'getAccount']);
    });



     // Explore
     Route::middleware('auth:sanctum')->prefix('explore')->group(function () {
        Route::post('exams', [StudentController::class, 'createAccount']);
        Route::get('me', [StudentController::class, 'getAccount']);
    });


});

