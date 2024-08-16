<?php

namespace Modules\Auth\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Modules\Billing\Entities\Plan;

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
            ], 422);
        }

        if (!$user->hasVerifiedEmail()) {
            return response([
                'status' => 'error',
                'message' => 'Please check your inbox for email verification'
            ], 401);
        }

        // user does not have account - create it now
        if(!$user->account ){
            $user->account()->create();
        }

        $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'influenzit'))->plainTextToken;


        $user = User::where('email', $request->email )->first();

        
        $response = [
            'user' => $user->load('account', 'driver', 'carrier'),
            'token' => $token
        ];

        return response([
            'status' => 'success',
            'message' => 'Login successfull',
            'data' => $response
        ], 200);
    }

    

}
