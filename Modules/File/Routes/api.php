<?php

use Illuminate\Http\Request;

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
    Route::middleware('auth:sanctum')->group(function() {
        Route::prefix('media')->group(function() {
            Route::resource('', 'FileController');
        });
    });




    Route::namespace('Admin')->prefix('admin/media')->group(function() {
        Route::group(['middleware' => ['auth:sanctum'] ], function() {
            Route::resource('', 'FileController', ['names' => 'admin.media']);
        });
    });
  
});