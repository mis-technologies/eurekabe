<?php

namespace Modules\Auth\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Modules\Auth\Http\Requests\RegisterRequest;
use NextApps\VerificationCode\VerificationCode;


class RegisterController extends Controller
{
    /**
     * Register
     */
    public function register(RegisterRequest $request)
    {

        $params = $request->validated();
        $params['password'] = Hash::make( $params['password'] );
        $user = User::create($params);

    
        VerificationCode::send($user->email);
        
        // event(new Registered($user) );

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successfull, please verify your email address',
        ]);
    }

}
