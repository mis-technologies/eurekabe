<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\Api\StudentController;
use Modules\Student\Http\Controllers\Api\StudentExamController;
use Modules\Student\Http\Controllers\Api\StudentLeaderBoardController;
use Modules\Student\Http\Controllers\Api\StudentNotificationController;
use App\Models\User;
use Modules\Student\Http\Controllers\Api\StudentChallengeController;
use Modules\Student\Http\Controllers\Api\StudentCompetitionController;

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


        // Competitions
        Route::prefix('competitions')->group(function () {
            Route::get('/',                                           [StudentCompetitionController::class, 'index']);
            Route::get('/{competition}',                              [StudentCompetitionController::class, 'show']);
            Route::post('/{competition}/join',                        [StudentCompetitionController::class, 'join']);
            Route::delete('/{competition}/leave',                     [StudentCompetitionController::class, 'leave']);
            Route::post('/{competition}/exams/{examId}/start',        [StudentCompetitionController::class, 'startExam']);
            Route::post('/{competition}/submit',                      [StudentCompetitionController::class, 'submitCompetitionExam']);
            Route::get('/{competition}/submission',                   [StudentCompetitionController::class, 'submission']);
            Route::get('/{competition}/leaderboard',                  [StudentCompetitionController::class, 'leaderboard']);
            Route::get('/{competition}/participants',                  [StudentCompetitionController::class, 'participants']);
        });

        // Challenges
        Route::prefix('challenges')->group(function () {
            Route::get('/',                                        [StudentChallengeController::class, 'index']);
            Route::post('/',                                       [StudentChallengeController::class, 'createChallenge']);
            Route::get('/{challenge}',                             [StudentChallengeController::class, 'show']);
            Route::patch('/{challenge}',                           [StudentChallengeController::class, 'updateChallenge']);
            Route::post('/{challenge}/accept',                     [StudentChallengeController::class, 'acceptChallenge']);
            Route::post('/{challenge}/reject',                     [StudentChallengeController::class, 'rejectChallenge']);
            Route::post('/{challenge}/participants',               [StudentChallengeController::class, 'addParticipants']);
            Route::delete('/{challenge}/participants/{user}',      [StudentChallengeController::class, 'removeParticipant']);
            Route::post('/{challenge}/start',                      [StudentChallengeController::class, 'startChallenge']);
            Route::post('/{challenge}/submit',                     [StudentChallengeController::class, 'submitChallenge']);
            Route::get('/{challenge}/result',                      [StudentChallengeController::class, 'getChallengeRanking']);
        });

    });


});

