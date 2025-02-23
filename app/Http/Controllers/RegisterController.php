<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use PhpParser\Node\Stmt\TryCatch;

class RegisterController extends Controller
{
    public function register(Request $request)
    {



        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
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
            'role' => 'advocate',
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'school_id' => $request->school_id,
            'ver_code' => $verificationCode,
            'ver_code_sent_at' => now(),
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

        Auth::login($user);

        return response()->json(['Request', Auth::user()->id]);
        // return response()->json(['Request', $request->all()]);

    }

    private static function generateVerificationCode()
    {
        $verificationCode = rand(100000, 999999);
        return $verificationCode;
    }
}
