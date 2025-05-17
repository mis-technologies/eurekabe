<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Wotz\VerificationCode\VerificationCode;

class ResetPasswordController extends Controller
{
    protected function sendResetResponse(){
        // do nothing here  - view is provided by frontend
        //  To show form for user to enter new password, while the token will be retrieved from the url
    }

    protected function resetPassword(Request $request){
        $input = $request->only('email','code', 'password', 'password_confirmation');
        
        $validator = Validator::make($input, [
            'code' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        if($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $user = User::whereEmail($request->email)->first();  
        
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email',
            ], 400);
       }

        $isvalid = VerificationCode::verify($input['code'], $user->email);
        if(!$isvalid ){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired code',
            ], 400);
        }

        $user->forceFill([
            'password' => Hash::make($input['password'])
        ])->save();

        $response = [
            'status' => 'success',
            'message' => 'password reset successfully',
        ];

        return response()->json($response);
    }
}
