<?php

use Illuminate\Support\Facades\Route;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Common\Http\Controllers\ExamController;
use Modules\Common\Http\Controllers\FileController;
use Modules\Common\Http\Controllers\FrontWebsiteController;
use Modules\Common\Http\Controllers\MessagingController;
use Modules\Common\Http\Controllers\PaymentController;
use Modules\Common\Http\Controllers\TestController;

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

Route::group([], function () {
    Route::resource('common', CommonController::class)->names('common');
    Route::resource('exam', ExamController::class)->names('exam');
    Route::resource('file', FileController::class)->names('file');
    Route::resource('frontwebsite', FrontWebsiteController::class)->names('frontwebsite');
    Route::resource('messaging', MessagingController::class)->names('messaging');
    Route::resource('payment', PaymentController::class)->names('payment');
    Route::resource('test', TestController::class)->names('test');
});
