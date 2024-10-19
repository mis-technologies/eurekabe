<?php

use Illuminate\Support\Facades\Route;
use Modules\Explore\Http\Controllers\Api\ExploreController;
use Modules\Explore\Http\Controllers\Api\ExploreExamController;
use Modules\Explore\Http\Controllers\Api\ExploreSchoolController;
use Modules\Explore\Http\Controllers\Api\ExploreStudentController;

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

Route::prefix('v1')->group(function () {

     Route::middleware('auth:sanctum')->prefix('explore')->group(function () {
        Route::get('/', [ExploreController::class, 'index']);
        Route::get('interests', [ExploreController::class, 'interests']);
        Route::apiResource('exams', ExploreExamController::class);
        Route::post('exams/{id}/favorites', [ExploreExamController::class, 'addExamToFavorite']);
        Route::apiResource('schools', ExploreSchoolController::class);
        Route::apiResource('students', ExploreStudentController::class);
    });


});
