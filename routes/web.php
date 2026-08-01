<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontWebsiteController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', [FrontWebsiteController::class, 'home']);

Route::get('/blogs', [FrontWebsiteController::class, 'blog'])->name('blogs');
Route::get('/blogs/{id}', [FrontWebsiteController::class, 'show'])->name('blogs.show');
Route::get('/events', [FrontWebsiteController::class, 'events'])->name('pages.events');
Route::get('/faq', [FrontWebsiteController::class, 'faq'])->name('pages.faq');
Route::get('/contact', [FrontWebsiteController::class, 'contact'])->name('pages.contact');
Route::get('/requestForm', [FrontWebsiteController::class, 'requestForm'])->name('pages.requestForm');
Route::get('/policy-privacy', [FrontWebsiteController::class, 'policyPrivacy'])->name('pages.policy-privacy');
Route::get('/terms-condition', [FrontWebsiteController::class, 'termsCondition'])->name('pages.terms-condition');

// Onboarding

// Route::prefix('advocate')->group(function () {
//     Route::post('/register', [RegisterController::class, 'register'])->name('pages.register');
// });
Route::get('/verify-email',[RegisterController::class, 'verifyEmail'] )->name('pages.verify.email');
Route::post('/verify',[RegisterController::class, 'verify'] )->name('verify');
Route::post('resend-email', [RegisterController::class, 'resendEmail'])->name('resend.email');

Route::get('/upload', function () {
    return view('upload');
});

Route::post('delete-account', [RegisterController::class, 'deleteAccount'])->name('page.delete-account');
Route::post('Verify-delete-useraccount', [RegisterController::class, 'VerifyDeleteUserAccount'])->name('verify.delete-useraccount');
Route::get('/verify-user-request', [RegisterController::class, 'verifyUserRequest'])->name('verifyUserRequest');


// Route::post('/upload', function (Request $request){
//     $request->validate([
//         'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
//     ]);
//     $path = $request->file('file')->store('uploads');
//     return redirect()->back()->with('success', 'File uploaded successfully')->with('file_url', Storage::url($path));
// })->name('file.upload');


Route::post('/upload', function (Request $request) {
    $request->validate([
        'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
    ]);

    // Get the uploaded file
    $file = $request->file('file');

    // Define the path where the file will be stored
    $destinationPath = public_path('uploads');
    $fileName = time() . '_' . $file->getClientOriginalName();

    // Move the file to the public/uploads directory
    $file->move($destinationPath, $fileName);

    // Generate the public URL for the file
    $fileUrl = url('uploads/' . $fileName);

    return redirect()->back()->with('success', 'File uploaded successfully')->with('file_url', $fileUrl);
})->name('file.upload');

// Volunteer call & application
use App\Http\Controllers\VolunteerApplicationController;

Route::get('/volunteer/apply', [VolunteerApplicationController::class, 'showForm'])->name('volunteer.apply');
Route::post('/volunteer/apply', [VolunteerApplicationController::class, 'submit'])->name('volunteer.apply.submit');
