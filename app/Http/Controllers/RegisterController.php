<?php

namespace App\Http\Controllers;

use App\Mail\DeleteUserNotification;
use App\Mail\DeleteUserVerification;
use App\Mail\EmailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;


class RegisterController extends Controller
{
    public function verifyEmail()
    {

        return view('pages.verify-email');

    }

    public function verify(Request $request)
    {
        $request->validate([
            'ver_code' => 'required|numeric|max_digits:6',
        ]);

        $email = $request->email;
        if (!$email) {
            return redirect()->route('pages.verify.email')->withErrors(['email' => 'No email found in session.']);
        }

        if ($request->delete == 'delete') {


            $user = User::where('email', $email)->first();

            if ($user->ver_code == $request->ver_code) {
                // $user->update(['deleted_at' => Carbon::now()]);

                Mail::to($user->email)->send(new DeleteUserNotification());
                $user->delete();
                $verified = session()->put('deleteVerified', true);

                return redirect()->route('verifyUserRequest')->with('success', 'Account deleted successfully.');
            }

            return redirect()->route('pages.verify.email')->withErrors(['ver_code' => 'Invalid verification code.']);
        }



        $user = User::where('email', $request->email)->first();
        // $user = User::where('email', 'xLDclintonace09@gmail.com')->first();

        if ($user->ver_code == $request->ver_code) {

            $user->email_verified_at = Carbon::now();
            $user->save();
            $verified = session()->put('verified', true);
        }

        return back();
    }

    public function register(Request $request)
    {

        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            // 'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'in:Male,Female,Other'],
            'school_id' => ['required', 'exists:schools,id'],
            'level' => ['required', 'integer', 'min:100', 'max:700'],
            'cgpa' => ['required', 'numeric', 'between:0.00,9.00'],

            'leading_experience' => ['required', 'string'],
            'position' => ['required', 'string'],
            'leading_attribute' => ['required', 'string'],
            'refereed_by' => ['required', 'in:Friends,Family,Social,Event'],
        ]);


        $verificationCode = self::generateVerificationCode();

        $user= User::create([
            'firstname' => $request->full_name,
            'email' => $request->email,
            // 'email' => Str::random(3).$request->email,
            'role' => 'advocate',
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'school_id' => $request->school_id,
            'ver_code' => $verificationCode,
            'ver_code_sent_at' => Carbon::now(),
            'level' => $request->level,
            'cgpa' => $request->cgpa,
            'leading_experience' => $request->leading_experience,
            'position' => $request->position,
            'leading_attribute' => $request->leading_attribute,
            'refereed_by' => $request->refereed_by,
        ]);

        try {
            Mail::to($user->email)->send(new EmailVerification($verificationCode));

        } catch (\Throwable $th) {
            //throw $th;
        }

        // Auth::login($user);

        // return response()->json(['Request', Auth::user()->id]);
        return response()->json(['Success', 'Advocate Registered Successfully']);

    }

    public function resendEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->first();

        $verificationCode = self::generateVerificationCode();

        $user->update([
            'ver_code' => $verificationCode,
            'ver_code_sent_at' => Carbon::now(),
        ]);

        try {
            Mail::to($user->email)->send(new EmailVerification($verificationCode));

        } catch (\Throwable $th) {
            //throw $th;
        }

        return back();
    }


    private static function generateVerificationCode()
    {
        $verificationCode = rand(100000, 999999);
        return $verificationCode;
    }

    public function deleteAccount()
    {
        return view('pages.delete-account');
    }

    public function VerifyDeleteUserAccount(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        // $verified = session()->put('deleteVerified', false);

        // User::withoutGlobalScopes()->withTrashed()->where('email', $request->email)->restore();

        // return back();
        $user = User::where('email', $request->email)->first();

        // dd($user);
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Account not found or not existing.']);
        }

        $verificationCode = self::generateVerificationCode();

        $user->update([
            'ver_code' => $verificationCode,
            'ver_code_sent_at' => Carbon::now(),
        ]);

        try {
            Mail::to($user->email)->send(new DeleteUserVerification($verificationCode));
        } catch (\Throwable $th) {
            return redirect()->route('verifyUserRequest')->withErrors(['email' => 'Failed to send verification code.']);
        }

        return redirect()->route('verifyUserRequest')->with('success', 'Verification code sent to your email.');
    }

    public function verifyUserRequest()
    {
        return view('pages.verify-user-request');
    }
}
