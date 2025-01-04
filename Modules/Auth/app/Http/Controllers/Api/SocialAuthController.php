<?php

namespace Modules\Auth\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Modules\Account\Entities\Account;

class SocialAuthController extends Controller
{

    /**
     * Google Social Login API
     */
    public function loginSocialUser(Request $request)
    {

        $validated = $request->validate([
            'code' => 'sometimes',
            'provider' => 'required'
        ]);
        
        $provider = $validated['provider'];
        $code = $validated['code'];

        if($provider === 'facebook'){
            return $this->loginWithFacebookAuthCode($code);
        }

        if($provider === 'google'){
            return $this->loginWithGoogleAuthCode($code);
        }
        
       
    }

    public function loginWithFacebookAuthCode($code){
        try {
            $provider = "facebook"; // or $request->input('provider_name') for multiple providers

            // get the provider's user. (In the provider server)
            $parameters = ['access_type' => 'offline'];
            // $driver = Socialite::driver($provider)->with($parameters);
            $socialUser = Socialite::driver($provider)->userFromToken($code); 
            // $socialUser = $driver->stateless()->user();

            $user = User::where('provider_name', $provider)
                ->where('provider_id', $socialUser->id)
                ->orWhere('email', $socialUser->email )->first();
            
            // if there is no record with these data, create a new user
            if(!$user){
                $user = User::create([
                    'provider_name' => $provider,
                    'provider_id' => $socialUser->id,
                    'provider_token' => $socialUser->token,
                    'email' => $socialUser->email,
                    'firstname' => $socialUser->name,
                    'lastname' => '',
                ]);
            }

            // do something with socialUser token here
            $user->update([
                'provider_token' => $socialUser->token,
                // 'profile_pic' => $socialUser->avatar,
                // 'provider_token_expiresin' => $socialUser->expiresIn,
                'provider_name' => $provider,
                'provider_id' => $socialUser->id,
            ]);

            Account::updateOrcreate(['user_id' => $user->id], ['user_id' => $user->id]);

            // create a token for the user, so they can login
            $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'influenzit'))->plainTextToken;


            $response = [
                'user' => $user->load('account'),
                'token' => $token
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Login successfull',
                'data' =>  $response
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ]);
           
        }
    }

    public function loginWithGoogleAuthCode($code){
        try {
            $provider = "google"; // or $request->input('provider_name') for multiple providers

            request()->merge([
                'code' => urldecode($code),
            ]);

            // get the provider's user. (In the provider server)
            $parameters = ['access_type' => 'offline'];

            $driver = Socialite::driver('google')->with($parameters);

           
            // $socialUser = $driver->stateless()->user(); //
            $socialUser =  $driver->userFromToken($code);


            $user = User::where('provider_name', $provider)
                ->where('provider_id', $socialUser->id)
                ->orWhere('email', $socialUser->email )->first();
            
            // if there is no record with these data, create a new user x
            if(!$user){
                $user = User::create([
                    'provider_name' => $provider,
                    'provider_id' => $socialUser->id,
                    'provider_token' => $socialUser->token,
                    'provider_token_expiresin' => $socialUser->expiresIn,
                    'email' => $socialUser->email,
                    'firstname' => $socialUser->name,
                    'lastname' => '',
                    'profile_pic' => $socialUser->avatar,
                ]);
            }

            // do something with socialUser token here
            $user->update([
                'provider_token' => $socialUser->token,
                'profile_pic' => $socialUser->avatar,
                'provider_token_expiresin' => $socialUser->expiresIn,
                'provider_name' => $provider,
                'provider_id' => $socialUser->id,
            ]);

            Account::updateOrcreate(['user_id' => $user->id], ['user_id' => $user->id]);

            // create a token for the user, so they can login
            $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'influenzit'))->plainTextToken;

            $response = [
                'user' => $user->load('account'),
                'token' => $token
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Login successfull',
                'data' =>  $response
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ]);
           
        }
    } 



    // WEB

    public function facebookRedirect()
    {
        // return Socialite::driver('facebook')->redirect();
        $facebookScope = [
            'user_birthday',
            'user_location',
            'pages_read_user_content',
            'pages_manage_ads',
            'pages_manage_metadata',
            'pages_read_engagement',
            'pages_manage_posts',
            'pages_manage_engagement',
            'business_management',
            
            'instagram_basic',
            // 'instagram_graph_user_media',
            // 'instagram_graph_user_profile',
            'email',
            'read_insights',
            'pages_show_list',
            'instagram_manage_insights',
            'instagram_content_publish',
            'public_profile',
        ];
        
        $facebookFields = [
                'name', // Default
                'email', // Default
                'gender', // Default
                'birthday', // I've given permission
                'location', // I've given permission
        ];
        return Socialite::driver('facebook')->scopes($facebookScope)->redirect();
    }


    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function loginWithFacebook()
    {
        try {

            $provider = "facebook"; // or $request->input('provider_name') for multiple providers
            $socialUser = Socialite::driver('facebook')->user();            
            $user = User::where('provider_name', $provider)->where('provider_id', $socialUser->id)->first();

            // if there is no record with these data, create a new user
            if(!$user){
                $user = User::create([
                    'provider_name' => $provider,
                    'provider_id' => $socialUser->id,
                    'provider_token' => $socialUser->token,
                    'email' => $socialUser->email,
                    'firstname' => $socialUser->name,
                    'lastname' => '',
                ]);
            }

            // do something with socialUser token here
            $user->update(['provider_token' => $socialUser->token]);

            Auth::login($user);
            return redirect()->route('welcome');
            
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function loginWithGoogle()
    {
        try {

            $provider = "facebook"; // or $request->input('provider_name') for multiple providers
            $socialUser = Socialite::driver('facebook')->user();            
            $user = User::where('provider_name', $provider)->where('provider_id', $socialUser->id)->first();

            // if there is no record with these data, create a new user
            if(!$user){
                $user = User::create([
                    'provider_name' => $provider,
                    'provider_id' => $socialUser->id,
                    'provider_token' => $socialUser->token,
                    'email' => $socialUser->email,
                    'firstname' => $socialUser->name,
                    'lastname' => '',
                ]);
            }

            // do something with socialUser token here
            $user->update(['provider_token' => $socialUser->token]);

            Auth::login($user);
            return redirect()->route('welcome');
            
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }



    public function loginSocialUserWithGoogleToken(Request $request){
        try {
            $provider = "google"; // or $request->input('provider_name') for multiple providers

            // get the provider's user. (In the provider server)
            $token = $request->input('access_token');

            $socialUser = Socialite::driver($provider)->stateless()->userFromToken($token);



            $user = User::where('provider', $provider)
                ->where('provider_id', $socialUser->id)
                ->orWhere('email', $socialUser->email )->first();
            
            // if there is no record with these data, create a new user
            if(!$user){
                $user = User::create([
                    'provider' => $provider,
                    'provider_id' => $socialUser->id,
                    'email' => $socialUser->email,
                    'firstname' => $socialUser->name,
                    'lastname' => '',
                    'password' => $socialUser->token,
                ]);
            }

            // do something with socialUser token here
            $user->update([
                'profile_pic' => $socialUser->avatar,
                'provider' => $provider,
                'provider_id' => $socialUser->id,
            ]);


            // create a token for the user, so they can login
            $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'eureka'))->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'data' =>  $response
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ]);
           
        }
    }




    // public function loginSocialUserWithGoogleToken(Request $request)
    // {
    //     try {
    //         $provider = "google"; // or $request->input('provider_name') for multiple providers
    
    //         // get the provider's user. (In the provider server)
    //         $token = $request->input('access_token');
    
    //         // Make an HTTP request to the Google API to get user info
    //         $client = new Client();
    //         $response = $client->get('https://www.googleapis.com/oauth2/v1/userinfo', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $token,
    //             ],
    //         ]);
    
    //         $socialUser = json_decode($response->getBody()->getContents());
    
    //         $user = User::where('provider_name', $provider)
    //             ->where('provider_id', $socialUser->id)
    //             ->orWhere('email', $socialUser->email)->first();
    
    //         // if there is no record with these data, create a new user
    //         if (!$user) {
    //             $user = User::create([
    //                 'provider_name' => $provider,
    //                 'provider_id' => $socialUser->id,
    //                 'provider_token' => $token,
    //                 'email' => $socialUser->email,
    //                 'firstname' => $socialUser->given_name,
    //                 'lastname' => $socialUser->family_name,
    //             ]);
    //         }
    
    //         // do something with socialUser token here
    //         $user->update([
    //             'provider_token' => $token,
    //             'profile_pic' => $socialUser->picture,
    //             'provider_name' => $provider,
    //             'provider_id' => $socialUser->id,
    //         ]);
    
    //         // create a token for the user, so they can login
    //         $token = $user->createToken(env('TOKEN_SECRET_PHRASE', 'influenzit'))->plainTextToken;
    
    //         $response = [
    //             'user' => $user->load('account'),
    //             'token' => $token
    //         ];
    
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Login successful',
    //             'data' => $response
    //         ]);
    //     } catch (\Exception $exception) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $exception->getMessage()
    //         ]);
    //     }
    // }
}
