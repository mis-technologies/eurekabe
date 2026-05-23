<?php

namespace Modules\Common\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Modules\Common\Http\Requests\RegisterRequest;
use Wotz\VerificationCode\VerificationCode;

class RegisterController extends Controller
{
    /**
     * Register — email must be verified via OTP before account is created.
     */
    public function register(RegisterRequest $request)
    {
        $params = $request->validated();

        $isValid = VerificationCode::verify($params['code'], $params['email']);
        if (!$isValid) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired verification code.',
            ], 400);
        }

        // Remove code before persisting
        unset($params['code']);
        $params['password'] = Hash::make($params['password']);

        // Delete any unverified stub account for this email before creating the real one
        User::whereEmail($params['email'])->whereNull('email_verified_at')->delete();

        $user = User::create($params);
        $user->generateUsername();
        $user->markEmailAsVerified();

        $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'eureka'))->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful.',
            'data' => [
                'user'  => $user,
                'token' => $token,
            ],
        ]);
    }

}
