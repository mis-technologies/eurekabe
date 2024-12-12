<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontWebsiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', [FrontWebsiteController::class, 'events'])->name('pages.event');
Route::get('/faq', [FrontWebsiteController::class, 'faq'])->name('pages.faq');
Route::get('/contact', [FrontWebsiteController::class, 'contact'])->name('pages.contact');
// Route::get('/requestForm', [FrontWebsiteController::class, 'requestForm'])->name('pages.requestForm');