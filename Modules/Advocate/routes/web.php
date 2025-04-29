<?php

use Illuminate\Support\Facades\Route;
use Modules\Advocate\Http\Controllers\AdvocateAuthController;
use Modules\Advocate\Http\Controllers\AdvocateController;
use Modules\Advocate\Http\Controllers\AdvocateExamController;
use Modules\Advocate\Http\Controllers\AdvocateStudentController;
use Modules\Advocate\Http\Controllers\AdvocateAIExamController;
use Modules\Advocate\Http\Controllers\AdvocateCompetitionController;

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


Route::get('advocate/forgot-password', [AdvocateAuthController::class, 'forgotPasswordPage'])->name('advocate.forgot.password');
Route::post('advocate/reset-password-link', [AdvocateAuthController::class, 'resetPasswordLink'])->name('advocate.reset.password.link');

Route::get('advocate/reset-password-view/{token?}', [AdvocateAuthController::class, 'resetPasswordView'])->name('advocate.reset.password.view');
Route::post('advocate/change-password', [AdvocateAuthController::class, 'changePassword'])->name('advocate.change.password');

Route::group(['middleware'=> 'advocate'], function () {
    Route::get('advocate/dashboard', [AdvocateController::class, 'dashboard'])->name('advocate.dashboard');

      // Exams and Results
    Route::get('advocate/exams', [AdvocateExamController::class, 'index'])->name('advocate.exams.index');
    Route::get('advocate/exams/ai', [AdvocateExamController::class, 'aiCreate'])->name('advocate.ai_create_exam');
    Route::get('advocate/exams/create', [AdvocateExamController::class, 'create'])->name('advocate.exams.create');
    Route::post('advocate/exams/store', [AdvocateExamController::class, 'storeExam'])->name('advocate.exams.store');
    Route::get('advocate/exams/{exam}', [AdvocateExamController::class, 'show'])->name('advocate.exams.show');
    Route::post('advocate/exams/{exam}', [AdvocateExamController::class, 'update'])->name('advocate.exams.update');
    Route::get('advocate/exams/{exam}/questions/create', [AdvocateExamController::class, 'getCreateQuestion'])->name('advocate.exams.question.create');
    Route::post('advocate/exams/{exam}/questions/store', [AdvocateExamController::class, 'storeQuestion'])->name('advocate.exams.question.store');
    Route::get('advocate/exams/{exam}/results', [AdvocateExamController::class, 'getExamResults'])->name('advocate.exams.results');
    Route::get('advocate/results', [AdvocateExamController::class, 'allExamResults'])->name('advocate.results');
    Route::get('advocate/exams/{exam}/questions/{question}', [AdvocateExamController::class, 'getQuestion'])->name('advocate.exams.question.show');
    Route::post('advocate/exams/{exam}/questions/{question}', [AdvocateExamController::class, 'updateQuestion'])->name('advocate.exams.question.update');


    // Students
    Route::get('advocate/students', [AdvocateStudentController::class, 'getStudents'])->name('advocate.students.index');
    Route::get('advocate/students/{student}', [AdvocateStudentController::class, 'showStudent'])->name('advocate.students.show');


    // Competition
    Route::get('advocate/competitions', [AdvocateCompetitionController::class, 'getCompetitions'])->name('advocate.competitions.index');
    Route::get('advocate/competitions/create', [AdvocateCompetitionController::class, 'createCompetition'])->name('advocate.competitions.create');
    Route::get('advocate/competitions/{competition}/edit', [AdvocateCompetitionController::class, 'editCompetition'])->name('advocate.competitions.edit');
    Route::post('advocate/competitions/{competition}/update', [AdvocateCompetitionController::class, 'updateCompetition'])->name('advocate.competitions.update');
    Route::post('advocate/competitions/store', [AdvocateCompetitionController::class, 'storeCompetitions'])->name('advocate.competitions.store');
    Route::get('advocate/competitions/{competition}', [AdvocateCompetitionController::class, 'showCompetition'])->name('advocate.competitions.show');

    Route::get('advocate/logout', [AdvocateAuthController::class, 'logout'])->name('advocate.logout');

});
