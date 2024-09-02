<?php

namespace Modules\Auth\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Login
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email )->first();

        // Check password

        if($user && !$user->password) {
            return response([
                'status' => 'error',
                'message' => 'Email is linked to social media profile, please try loggin in with a social account'
            ], 422);
        }


        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'status' => 'error',
                'message' => 'Incorrect password or email'
            ], 401);
        }

        if (!$user->hasVerifiedEmail()) {
            return response([
                'status' => 'error',
                'message' => 'Please check your inbox for email verification'
            ], 403);
        }

       

        $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'influenzit'))->plainTextToken;


        $user = User::where('email', $request->email )->first();

        
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response([
            'status' => 'success',
            'message' => 'Login successfull',
            'data' => $response
        ], 200);
    }

    

}
