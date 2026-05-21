<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\ResetPasswordVerificationNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Common\Http\Requests\ForgetPasswordRequest;
use Wotz\VerificationCode\VerificationCode;

class PasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password  Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests, forgot password request etc
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

   
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
            //recent code has already been verified
            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Invalid or expired code',
            // ], 400);
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



    public function forgotPassword(ForgetPasswordRequest $request)
    {
        $input = $request->only('email');
        $user = User::where('email', $input)->first();
        // $user->notify(new ResetPasswordVerificationNotification());
       
        VerificationCode::send($user->email);

        return response()->json([
            'success' => true,
            'message' => 'Please kindly check Email , An Otp has been sent to change password.',
        ], 200);
    }


    protected function changePassword(Request $request){
        $input = $request->only('old_password', 'new_password', 'new_password_confirmation');
        $userId = Auth::id();
        $authUser = User::find($userId);
        if(!$authUser){
            return response([
                "status" => "error",
                "message" => "user not found"
            ], 404);
        }
        
        $validator = Validator::make($input, [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if($validator->fails()) {
            return response([
                "status" => "error",
                "message" => "validation failed",
                'errors'=>$validator->errors()->all(),
            ],422);
        }

        if(!Hash::check( $input['old_password'], $authUser->password)){
            return response([
                "status" => "error",
                "message" => "old password is incorrect"
            ],403);
        }

        $authUser->forceFill([
            'password' => Hash::make($input['new_password'])
        ])->save();

        return response()->json([
            "status" => "success",
            "message" => 'Password changed successfully',
        ], 200);
    }
}
