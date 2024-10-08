<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\Api\StudentController;
use Modules\Student\Http\Controllers\Api\StudentExamController;

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

  
    Route::middleware('auth:sanctum')->prefix('student')->group(function () {
       
        Route::post('account', [StudentController::class, 'createAccount']);
        Route::get('me', [StudentController::class, 'getAccount']);
        Route::patch('me', [StudentController::class, 'updateAccount']);


        // Exam
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('exams', [StudentExamController::class, 'index']);
            Route::get('exams/{studentExam}', [StudentExamController::class, 'show']);
            Route::post('exams/{exam}/start', [StudentExamController::class, 'start']);
            Route::post('exams/{studentExam}/submit', [StudentExamController::class, 'submit']);
        });
    });


});

