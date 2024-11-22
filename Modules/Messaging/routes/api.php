<?php

use Illuminate\Support\Facades\Route;
use Modules\Messaging\Http\Controllers\Api\ConversationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->prefix('v1')->group(function() {
    Route::middleware('auth:sanctum')->prefix('messaging')->group(function () {
        Route::post('conversations', [ConversationController::class, 'startConversation']);    
        Route::get('conversations', [ConversationController::class, 'getConversations']);    
        Route::get('conversations/{id}', [ConversationController::class, 'show']);    
        Route::get('conversations/{id}/messages', [ConversationController::class, 'getConversationMessages']);    
        Route::post('conversations/{id}/messages', [ConversationController::class, 'sendMessage']);   
    });

});