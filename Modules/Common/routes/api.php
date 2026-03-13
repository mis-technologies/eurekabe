<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Common\Actions\OpenRouter;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Exam\Http\Controllers\AIExamController;

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
    Route::apiResource('common', CommonController::class)->names('common');

    // USER
    // Route::middleware('auth:sanctum')->prefix('common')->group(function () {
    //     Route::get('notifications', [NotificationController::class, 'getNotifications']);
    //     Route::get('notifications/unread', [NotificationController::class, 'getUnreadNotifications']);
    //     Route::get('notifications/mark-all-read', [NotificationController::class, 'markAllRead']);
    //     Route::get('notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead']);
    // });

// TESTING

    Route::prefix('testing')->group(function () {

        Route::post('generate-questions', function (Request $request) {

            $prompt = $request->prompt ?? "Please generate 5 questions for Basic Mechanics within Physics, focusing on Newton's Laws of Motion. Include both conceptual and numerical questions";
            $res = OpenRouter::chat([
                [
                    "role" => "user",
                    "content" => "Please generate multiple-choice exam questions for Physics following these requirements:
            
                    1. Create questions with 4 answer options each
                    2. Each question should:
                    - Be clear and unambiguous
                    - Test a specific concept or knowledge point
                    - Have only one correct answer
                    - Include plausible but incorrect distractors
                    - Return a JSON, do not add any pretext and do not use any new line characters
            
                    Format each question exactly as shown in this JSON structure:
                    [
                        {
                            \"question\": \"Question text here\",
                            \"marks\": 1.0,
                            \"options\": [
                                {
                                    \"option\": \"Option text\",
                                    \"is_correct\": false
                                },
                                {
                                    \"option\": \"Option text\",
                                    \"is_correct\": true
                                }
                            ]
                        }
                    ]
                    $prompt",
                ]
            ], 'mistralai/ministral-8b');
            

            $content = $res['choices'][0]['message']['content'];

            $questions = OpenRouter::processResponse($content);

            return response()->json([
                'success' => true,
                'data' => $questions,
            ]);

        });

        Route::post('generate-questions-batch', [AIExamController::class, 'generateQuestions']);

    });

});

