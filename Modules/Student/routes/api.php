<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\Api\StudentController;
use Modules\Student\Http\Controllers\Api\StudentExamController;
use Modules\Student\Http\Controllers\Api\StudentLeaderBoardController;

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
       
        //Student Account
        Route::post('account', [StudentController::class, 'createAccount']);
        Route::get('me', [StudentController::class, 'getAccount']);
        Route::patch('me', [StudentController::class, 'updateAccount']);

        // Student Exam
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('exams', [StudentExamController::class, 'index']);
            Route::post('exams/{exam}/start', [StudentExamController::class, 'start']);
            Route::post('exams/{studentExam}/submit', [StudentExamController::class, 'submit']);
            Route::get('exams/{studentExam}/result', [StudentExamController::class, 'getExamResult']);
            Route::post('exams/{studentExam}/feedback', [StudentExamController::class, 'addExamFeedback']);
            Route::post('exams/favorites', [StudentExamController::class, 'addExamToFavorite']);
            Route::get('exams/favorites', [StudentExamController::class, 'getFavoriteExams']);
            Route::get('exams/{studentExam}', [StudentExamController::class, 'show']);
        });

        // Leaderboard
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('leaderboard/weekly', [StudentLeaderBoardController::class, 'weeklyLeaderboard']);
            Route::get('leaderboard/monthly', [StudentLeaderBoardController::class, 'monthlyLeaderboard']);
            Route::get('leaderboard/yearly', [StudentLeaderBoardController::class, 'yearlyLeaderboard']);
        });       
    });


});

