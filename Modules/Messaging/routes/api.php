<?php

use Illuminate\Support\Facades\Route;
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


    /**
     *  USER MESSAGING ENDPOINTS
     *  
     **/
    Route::middleware('auth:sanctum')->group(function() {
        Route::resource('messages', 'MessageController');    
       
        Route::post('messaging/conversations', 'ConversationController@store');    
        Route::get('messaging/conversations', 'ConversationController@index');    
        Route::get('messaging/conversations/{id}', 'ConversationController@show');    
        Route::patch('messaging/{id}', 'ConversationController@update');    

        Route::get('messaging/conversations/{id}/messages', 'ConversationController@getMessages');    
        Route::post('messaging/conversations/{id}/messages', 'ConversationController@sendMessage');    
    });



    /*
        ADMIN
    */

    Route::namespace('Admin')->prefix('admin')->group(function() {
        Route::group(['middleware' => ['auth:sanctum'] ], function() {
            //Route::resource('messages', 'MessageController', ['names' => 'admin.users']);
        });
    });
  
});