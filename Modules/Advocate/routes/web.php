<?php

use Illuminate\Support\Facades\Route;
use Modules\Advocate\Http\Controllers\AdvocateAuthController;
use Modules\Advocate\Http\Controllers\AdvocateController;
use Modules\Advocate\Http\Controllers\AdvocateExamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('advocate/login', [AdvocateAuthController::class, 'showLoginForm'])->name('advocate.login');
Route::post('advocate/login', [AdvocateAuthController::class, 'login'])->name('advocate.login.send');
Route::get('advocate/apply', [AdvocateAuthController::class, 'showRegistrationForm'])->name('advocate.apply');
Route::get('advocate/verify-email',[AdvocateAuthController::class, 'verifyEmail'] )->name('advocate.verify.email');
Route::post('advocate/verify',[AdvocateAuthController::class, 'verify'] )->name('advocate.verify');
Route::post('advocate/resend-email', [AdvocateAuthController::class, 'resendEmail'])->name('advocate.resend.email');
Route::post('advocate/register', [AdvocateAuthController::class, 'register'])->name('advocate.apply.send');

Route::group(['middleware'=> 'advocate'], function () {
    Route::get('advocate/dashboard', [AdvocateController::class, 'dashboard'])->name('advocate.dashboard');
    Route::get('advocate/exams', [AdvocateExamController::class, 'index'])->name('advocate.exams.index');
    Route::get('advocate/exams/create', [AdvocateExamController::class, 'create'])->name('advocate.exams.create');
    Route::post('advocate/exams/store', [AdvocateExamController::class, 'storeExam'])->name('advocate.exams.store');
    Route::get('advocate/exams/{exam}', [AdvocateExamController::class, 'show'])->name('advocate.exams.show');
    Route::post('advocate/exams/{exam}', [AdvocateExamController::class, 'update'])->name('advocate.exams.update');

    Route::get('advocate/exams/{exam}/questions/create', [AdvocateExamController::class, 'getCreateQuestion'])->name('advocate.exams.question.create');
    Route::post('advocate/exams/{exam}/questions/store', [AdvocateExamController::class, 'storeQuestion'])->name('advocate.exams.question.store');


    Route::get('advocate/exams/{exam}/questions/{question}', [AdvocateExamController::class, 'getQuestion'])->name('advocate.exams.question.show');
    Route::post('advocate/exams/{exam}/questions/{question}', [AdvocateExamController::class, 'updateQuestion'])->name('advocate.exams.question.update');
    Route::get('advocate/logout', [AdvocateAuthController::class, 'logout'])->name('advocate.logout');
});
