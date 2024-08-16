<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Validator;
use NextApps\VerificationCode\VerificationCode;


class ForgotPasswordController extends Controller
{
    protected function sendResetLinkResponse(Request $request){
        $input = $request->only('email');
        
        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);

        if ($validator->fails()) {            
            return response()->json([
                'status' => 'error',
                'message' => 'Email is required',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = User::whereEmail($request->email)->first();  
        
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email',
            ]);
       }

        VerificationCode::send($user->email);

        return response()->json([
            "status" => "success",
            "message" => "Email verification link sent on your email"
        ]);
    }



}
