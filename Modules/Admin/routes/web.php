<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminAuthController;
use Modules\Admin\Http\Controllers\AdminBillingController;
use Modules\Admin\Http\Controllers\AdminCategoryController;
use Modules\Admin\Http\Controllers\AdminCompetitionController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\AdminExamController;
use Modules\Admin\Http\Controllers\AdminMaterialController;
use Modules\Admin\Http\Controllers\AdminNotificationController;
use Modules\Admin\Http\Controllers\AdminResultController;
use Modules\Admin\Http\Controllers\AdminSchoolController;
use Modules\Admin\Http\Controllers\AdminUserController;

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

// Route::group([], function () {
//     Route::resource('admin', AdminController::class)->names('admin');
// });




Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.send');



Route::group(['middleware'=> 'isadmin'], function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('admin/students', [AdminController::class, 'allStudents'])->name('admin.students');
    Route::get('admin/advocates', [AdminController::class, 'allAdvocates'])->name('admin.advocates');
    Route::post('admin/user/approve-disapprove/{id?}', [AdminController::class, 'update'])->name('admin.update.user.status');

    // Home Page
    Route::get('/admin/pages/home', [AdminController::class, 'showHomePage'])->name('admin.pages.home');
    Route::post('/admin/pages/home', [AdminController::class, 'updateHomePage'])->name('admin.pages.home.update');


    // Blog Crud
    Route::get('/admin/pages/blog', [AdminController::class, 'blogDisplay'])->name('admin.pages.blog.display');
    Route::post('/admin/pages/blog-update/{blog_id?}', [AdminController::class, 'blogUpdate'])->name('admin.pages.update.blog');
    Route::get('/admin/pages/blog-update-view/{blog_id?}', [AdminController::class, 'blogUpdateView'])->name('admin.pages.update.blog.view');
    Route::get('/admin/pages/blog-delete/{blog_id}', [AdminController::class, 'deleteBlog'])->name('admin.pages.delete.blog');


    Route::get('/admin/pages/events', [AdminController::class, 'eventsDisplay'])->name('admin.pages.events.display');
    Route::post('/admin/pages/event-update/{event_id?}', [AdminController::class, 'eventUpdate'])->name('admin.pages.update.event');
    Route::get('/admin/pages/event-update-view/{event_id?}', [AdminController::class, 'eventUpdateView'])->name('admin.pages.update.event.view');
    Route::get('/admin/pages/event-delete/{event_id}', [AdminController::class, 'deleteEvent'])->name('admin.pages.delete.event');

    // Volunteer Applications
    Route::get('/admin/volunteers', [AdminController::class, 'volunteers'])->name('admin.volunteers');
    Route::get('/admin/volunteers/{id}', [AdminController::class, 'showVolunteer'])->name('admin.volunteers.show');
    Route::post('/admin/volunteers/{id}/status', [AdminController::class, 'updateVolunteerStatus'])->name('admin.volunteers.update-status');

    // Exams
    Route::get('/admin/exams', [AdminExamController::class, 'index'])->name('admin.exams.index');
    Route::get('/admin/exams/create', [AdminExamController::class, 'create'])->name('admin.exams.create');
    Route::post('/admin/exams', [AdminExamController::class, 'store'])->name('admin.exams.store');
    Route::get('/admin/exams/{id}', [AdminExamController::class, 'show'])->name('admin.exams.show');
    Route::get('/admin/exams/{id}/edit', [AdminExamController::class, 'edit'])->name('admin.exams.edit');
    Route::post('/admin/exams/{id}', [AdminExamController::class, 'update'])->name('admin.exams.update');
    Route::get('/admin/exams/{id}/delete', [AdminExamController::class, 'destroy'])->name('admin.exams.delete');
    Route::get('/admin/exams/{id}/questions', [AdminExamController::class, 'questions'])->name('admin.exams.questions');
    Route::post('/admin/exams/{id}/questions', [AdminExamController::class, 'storeQuestion'])->name('admin.exams.questions.store');
    Route::get('/admin/exams/{id}/questions/{questionId}/delete', [AdminExamController::class, 'destroyQuestion'])->name('admin.exams.questions.delete');

    // Schools
    Route::get('/admin/schools', [AdminSchoolController::class, 'index'])->name('admin.schools.index');
    Route::get('/admin/schools/create', [AdminSchoolController::class, 'create'])->name('admin.schools.create');
    Route::post('/admin/schools', [AdminSchoolController::class, 'store'])->name('admin.schools.store');
    Route::get('/admin/schools/{id}/edit', [AdminSchoolController::class, 'edit'])->name('admin.schools.edit');
    Route::post('/admin/schools/{id}', [AdminSchoolController::class, 'update'])->name('admin.schools.update');
    Route::get('/admin/schools/{id}/delete', [AdminSchoolController::class, 'destroy'])->name('admin.schools.delete');

    // Categories & Subjects
    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [AdminCategoryController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/admin/categories/{id}/delete', [AdminCategoryController::class, 'destroyCategory'])->name('admin.categories.delete');
    Route::post('/admin/subjects', [AdminCategoryController::class, 'storeSubject'])->name('admin.subjects.store');
    Route::get('/admin/subjects/{id}/delete', [AdminCategoryController::class, 'destroySubject'])->name('admin.subjects.delete');

    // Competitions
    Route::get('/admin/competitions', [AdminCompetitionController::class, 'index'])->name('admin.competitions.index');
    Route::get('/admin/competitions/create', [AdminCompetitionController::class, 'create'])->name('admin.competitions.create');
    Route::post('/admin/competitions', [AdminCompetitionController::class, 'store'])->name('admin.competitions.store');
    Route::get('/admin/competitions/{id}', [AdminCompetitionController::class, 'show'])->name('admin.competitions.show');
    Route::get('/admin/competitions/{id}/edit', [AdminCompetitionController::class, 'edit'])->name('admin.competitions.edit');
    Route::post('/admin/competitions/{id}', [AdminCompetitionController::class, 'update'])->name('admin.competitions.update');
    Route::post('/admin/competitions/{id}/status', [AdminCompetitionController::class, 'updateStatus'])->name('admin.competitions.status');
    Route::post('/admin/competitions/{id}/broadcast', [AdminCompetitionController::class, 'broadcast'])->name('admin.competitions.broadcast');
    Route::get('/admin/competitions/{id}/delete', [AdminCompetitionController::class, 'destroy'])->name('admin.competitions.delete');
    Route::post('/admin/competitions/{id}/exams', [AdminCompetitionController::class, 'addExam'])->name('admin.competitions.exams.add');
    Route::get('/admin/competitions/{id}/exams/{examId}/remove', [AdminCompetitionController::class, 'removeExam'])->name('admin.competitions.exams.remove');

    // Users
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::post('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/users/{id}/delete', [AdminUserController::class, 'destroy'])->name('admin.users.delete');
    Route::post('/admin/users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggle-status');

    // Materials
    Route::get('/admin/materials', [AdminMaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('/admin/materials/{id}', [AdminMaterialController::class, 'show'])->name('admin.materials.show');
    Route::get('/admin/materials/{id}/delete', [AdminMaterialController::class, 'destroy'])->name('admin.materials.delete');

    // Notifications
    Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/admin/notifications/send', [AdminNotificationController::class, 'send'])->name('admin.notifications.send');

    // Results / Exam Attempts
    Route::get('/admin/results', [AdminResultController::class, 'index'])->name('admin.results.index');
    Route::get('/admin/results/{id}', [AdminResultController::class, 'show'])->name('admin.results.show');

    // Billing
    Route::get('/admin/billing/plans', [AdminBillingController::class, 'plans'])->name('admin.billing.plans');
    Route::post('/admin/billing/plans', [AdminBillingController::class, 'storePlan'])->name('admin.billing.plans.store');
    Route::post('/admin/billing/plans/{id}', [AdminBillingController::class, 'updatePlan'])->name('admin.billing.plans.update');
    Route::post('/admin/billing/plans/{id}/toggle', [AdminBillingController::class, 'togglePlan'])->name('admin.billing.plans.toggle');
    Route::get('/admin/billing/plans/{id}/delete', [AdminBillingController::class, 'deletePlan'])->name('admin.billing.plans.delete');
    Route::get('/admin/billing/costs', [AdminBillingController::class, 'costs'])->name('admin.billing.costs');
    Route::post('/admin/billing/costs/{id}', [AdminBillingController::class, 'updateCost'])->name('admin.billing.costs.update');
    Route::get('/admin/billing/payments', [AdminBillingController::class, 'payments'])->name('admin.billing.payments');
    Route::get('/admin/billing/adjust', [AdminBillingController::class, 'adjustCredits'])->name('admin.billing.adjust');
    Route::post('/admin/billing/adjust', [AdminBillingController::class, 'applyAdjustment'])->name('admin.billing.adjust.apply');

    // Subscriptions
    Route::get('/admin/billing/subscriptions', [AdminBillingController::class, 'subscriptions'])->name('admin.billing.subscriptions');
    Route::post('/admin/billing/subscriptions/{id}/cancel', [AdminBillingController::class, 'cancelSubscription'])->name('admin.billing.subscriptions.cancel');
    Route::post('/admin/billing/subscriptions/{id}/extend', [AdminBillingController::class, 'extendSubscription'])->name('admin.billing.subscriptions.extend');
    Route::post('/admin/billing/subscriptions/{id}/force-renew', [AdminBillingController::class, 'forceRenewSubscription'])->name('admin.billing.subscriptions.force-renew');

});
