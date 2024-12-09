<?php

namespace Modules\Auth\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Wotz\VerificationCode\VerificationCode;

class VerificationController extends Controller
{
    
    public function verify($user_id, Request $request) {
       
        if (!$request->hasValidSignature()) {
            return response()->json(["message" => "Invalid/Expired url provided."], 401);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        if( $request->wantsJson() ){
            return response()->json([
                'status' => 'success',
                'message' => 'Email verified',
            ], 200);
        }

        //event(new EmailVerified($user) );
        return redirect()->away('app://open');

    }


    public function resend(Request $request) {
        if (auth()->user() && auth()->user()->hasVerifiedEmail()) {
            return response()->json(["message" => "Email already verified."], 400);
        }

        $user = User::whereEmail($request->email)->firstOrFail();
        $user->sendEmailVerificationNotification();
        return response()->json(["message" => "Email verification link sent on your email"]);
    }

    public function verifyCode(Request $request) {
        $user = User::whereEmail($request->email)->first();

       if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email',
            ]);
       }

        $isvalid = VerificationCode::verify($request->code, $user->email);
        if(!$isvalid ){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired code',
            ], 400);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        if(!$user->account ){
            $user->account()->create();
        }

        // $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'influenzit'))->plainTextToken;

        // $response = [
        //     'user' => $user->load('account'),
        //     'token' => $token
        // ];

        $response = [
            'status' => 'success',
            'message' => 'email verified successfully',
            // 'data' =>  $response
        ];

        return response()->json($response);
    }

    public function resendCode(Request $request) {
        
        if (auth()->user() && auth()->user()->hasVerifiedEmail()) {
            return response()->json([
                "status" => "error",
                "message" => "Email already verified."
            ], 400);
        }

        $user = User::whereEmail($request->email)->first();  
        
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email',
            ]);
       }

       if ( $user->hasVerifiedEmail() ) {
            return response()->json([
                "status" => "error",
                "message" => "Email already verified."
            ], 400);
        }


        VerificationCode::send($user->email);
        return response()->json([
            "status" => "success",
            "message" => "Email verification code sent on your email"
        ]);
    }

}
