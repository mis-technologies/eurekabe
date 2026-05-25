<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Common\Actions\OpenRouter;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Common\Http\Controllers\AIExamController;
use Modules\Common\Http\Controllers\ExamController;
use Modules\Common\Http\Controllers\FileController;
use Modules\Common\Http\Controllers\FrontWebsiteController;
use Modules\Common\Http\Controllers\MessagingController;
use Modules\Common\Http\Controllers\PaymentController;
use Modules\Common\Http\Controllers\TestController;
use Modules\Common\Http\Controllers\Api\EmailController;
use Modules\Common\Http\Controllers\Api\LoginController;
use Modules\Common\Http\Controllers\Api\PasswordController;
use Modules\Common\Http\Controllers\Api\RegisterController;
use Modules\Common\Http\Controllers\Api\SocialAuthController;
use Modules\Common\Http\Controllers\Api\ExploreController;
use Modules\Common\Http\Controllers\Api\ExploreExamController;
use Modules\Common\Http\Controllers\Api\ExploreSchoolController;
use Modules\Common\Http\Controllers\Api\ExploreStudentController;
use Modules\Common\Http\Controllers\Api\ConversationController;
use Modules\Common\Http\Controllers\Api\AiTutorController;

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

    // ------------------------------------------------------------------
    // Common
    // ------------------------------------------------------------------
    Route::apiResource('common', CommonController::class)->names('common');

    // ------------------------------------------------------------------
    // Auth
    // ------------------------------------------------------------------
    Route::prefix('auth')->group(function () {
        Route::post('login', [LoginController::class, 'login']);
        Route::post('register', [RegisterController::class, 'register']);
        Route::post('email/send-code', [EmailController::class, 'sendCode']);
        Route::get('schools', [ExploreSchoolController::class, 'index']);
        Route::post('password/forgot', [PasswordController::class, 'forgotPassword']);
        Route::post('password/reset', [PasswordController::class, 'resetPassword']);
        Route::get('email/verify/{id}', [EmailController::class, 'verifyLink'])->name('email.verifylink');
        Route::post('email/verify', [EmailController::class, 'verifyCode'])->name('email.verifycode');
        Route::post('email/resend-code', [EmailController::class, 'resendCode'])->name('email.resendcode');
        Route::post('social/login-google', [SocialAuthController::class, 'loginSocialUserWithGoogleToken']);
    });

    Route::middleware('auth:sanctum')->prefix('user')->group(function () {
        Route::post('logout', [LoginController::class, 'logout']);
        Route::post('password/change', [PasswordController::class, 'changePassword']);
    });

    // ------------------------------------------------------------------
    // Exam
    // ------------------------------------------------------------------
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('exam', ExamController::class)->names('exam');
    });

    Route::post('generate-questions-batch', [AIExamController::class, 'generateQuestions']);
    Route::post('save-generated-ai-exam', [AIExamController::class, 'saveGeneratedExam']);

    // ------------------------------------------------------------------
    // Explore
    // ------------------------------------------------------------------
    Route::middleware('auth:sanctum')->prefix('explore')->group(function () {
        Route::get('/', [ExploreController::class, 'index']);
        Route::get('interests', [ExploreController::class, 'interests']);
        Route::apiResource('exams', ExploreExamController::class);
        Route::post('exams/{id}/favorites', [ExploreExamController::class, 'addExamToFavorite']);
        Route::get('exams/{id}/feedbacks', [ExploreExamController::class, 'getExamFeedbacks']);
        Route::apiResource('schools', ExploreSchoolController::class);
        Route::post('schools/{id}/follow', [ExploreSchoolController::class, 'follow']);
        Route::apiResource('students', ExploreStudentController::class);
    });

    // ------------------------------------------------------------------
    // File
    // ------------------------------------------------------------------
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('file', FileController::class)->names('file');
    });

    // ------------------------------------------------------------------
    // AI Tutor
    // ------------------------------------------------------------------
    Route::middleware('auth:sanctum')->prefix('ai')->group(function () {
        Route::post('ask', [AiTutorController::class, 'ask']);
    });

    // ------------------------------------------------------------------
    // Messaging
    // ------------------------------------------------------------------
    Route::middleware('auth:sanctum')->prefix('messaging')->group(function () {
        Route::post('conversations', [ConversationController::class, 'startConversation']);
        Route::get('conversations', [ConversationController::class, 'getConversations']);
        Route::get('conversations/{id}', [ConversationController::class, 'getSingleConversation']);
        Route::get('conversations/{id}/messages', [ConversationController::class, 'getConversationMessages']);
        Route::post('conversations/{id}/messages', [ConversationController::class, 'sendMessage']);
        Route::get('presence/{userId}', [ConversationController::class, 'getPresence']);
    });

    // ------------------------------------------------------------------
    // Payment
    // ------------------------------------------------------------------
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('payment', PaymentController::class)->names('payment');
    });

    // ------------------------------------------------------------------
    // Testing / AI
    // ------------------------------------------------------------------
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
