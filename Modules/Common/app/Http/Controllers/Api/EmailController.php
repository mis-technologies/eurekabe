<?php

namespace  Modules\Common\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Wotz\VerificationCode\VerificationCode;

class EmailController extends Controller
{

    public function verifyLink($user_id, Request $request)
    {

        if (!$request->hasValidSignature()) {
            return response()->json(["message" => "Invalid/Expired url provided."], 401);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Email verified',
            ], 200);
        }
        return redirect()->away('app://open');
    }


    public function resendLink(Request $request)
    {
        $user = User::whereEmail($request->email)->firstOrFail();
        if ($user && $user->hasVerifiedEmail()) {
            return response()->json(["message" => "Email already verified."], 400);
        }

        $user = User::whereEmail($request->email)->firstOrFail();
        $user->sendEmailVerificationNotification();
        return response()->json(["message" => "Email verification link sent on your email"]);
    }

    public function verifyCode(Request $request)
    {

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
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

        $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'eureka'))->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];


        $response = [
            'status' => 'success',
            'message' => 'email verified successfully',
            'data' =>  $response
        ];

        return response()->json($response);
    }


    public function resendCode(Request $request) {
        
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
