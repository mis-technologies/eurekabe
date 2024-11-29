<?php

use Illuminate\Support\Facades\Route;
use Modules\Common\Http\Controllers\Api\NotificationController;
use Modules\Common\Http\Controllers\CommonController;

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

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('common', CommonController::class)->names('common');
});


 // USER    
 Route::middleware('auth:sanctum')->prefix('common')->group(function() {
    Route::get('notifications', [NotificationController::class, 'getNotifications']);
    Route::get('notifications/unread', [NotificationController::class, 'getUnreadNotifications']);
    Route::get('notifications/mark-all-read', [NotificationController::class, 'markAllRead']);
    Route::get('notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead']);
});
