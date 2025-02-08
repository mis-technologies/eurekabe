<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::middleware('auth:sanctum')->post('/broadcasting/auth', function () {
//     return response()->json(['message' => 'Authorized'], 200);
// });