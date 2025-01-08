<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontWebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', [FrontWebsiteController::class, 'events'])->name('pages.event');
Route::get('/faq', [FrontWebsiteController::class, 'faq'])->name('pages.faq');
Route::get('/contact', [FrontWebsiteController::class, 'contact'])->name('pages.contact');
// Route::get('/requestForm', [FrontWebsiteController::class, 'requestForm'])->name('pages.requestForm');



Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', function (Request $request){
    $request->validate([
        'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
    ]);
    $path = $request->file('file')->store('uploads');
    return redirect()->back()->with('success', 'File uploaded successfully')->with('file_url', Storage::url($path));
})->name('file.upload');