<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\Api\StudentController;
use Modules\Student\Http\Controllers\Api\StudentExamController;
use Modules\Student\Http\Controllers\Api\StudentLeaderBoardController;
use Modules\Student\Http\Controllers\Api\StudentNotificationController;
use Modules\Student\Http\Controllers\Api\StudentChallengeController;

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
        Route::post('me/change-profile-picture', [StudentController::class, 'updateProfilePicture']);

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
        
        

        // Notification
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('notifications', [StudentNotificationController::class, 'getNotifications']);
            Route::get('notifications/mark-all-read', [StudentNotificationController::class, 'markAllRead']);
            Route::get('notifications/{notification}', [StudentNotificationController::class, 'getSingle']);
            Route::get('notifications/{notification}/mark-read', [StudentNotificationController::class, 'markAsRead']);
        });      


        // Challenges
        Route::middleware('auth:api')->group(function () {
            Route::get('challenges', [StudentChallengeController::class, 'index']);
            Route::get('challenges/{challenge}', [StudentChallengeController::class, 'show']);
            Route::post('challenges', [StudentChallengeController::class, 'createChallenge']);
            Route::post('challenges/{challenge}/accept', [StudentChallengeController::class, 'acceptChallenge']);
            Route::post('challenges/{challenge}/start', [StudentChallengeController::class, 'startChallenge']);
            Route::post('challenges/{challenge}/submit', [StudentChallengeController::class, 'submitChallenge']);
            Route::get('challenges/{challenge}/result', [StudentChallengeController::class, 'getChallengeRanking']);
        });

    });


});

