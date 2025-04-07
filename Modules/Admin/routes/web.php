<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminAuthController;
use Modules\Admin\Http\Controllers\AdminController;

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

});
