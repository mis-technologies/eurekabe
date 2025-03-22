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

});
