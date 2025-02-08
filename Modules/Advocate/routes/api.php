<?php

use Illuminate\Support\Facades\Route;
use Modules\Advocate\Http\Controllers\Api\AdvocateSchoolController;

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
    Route::middleware('auth:sanctum')->prefix('advocates')->group(function () {
        Route::post('schools', [AdvocateSchoolController::class, 'store']);
        Route::get('schools', [AdvocateSchoolController::class, 'index']);
        Route::get('schools/{school}', [AdvocateSchoolController::class, 'show']);
    });



});

