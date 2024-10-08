<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Common\Models\School;
use Modules\Student\Models\Student;

class StudentController extends Controller
{

    public function createAccount(Request $request)
    {
        try {

            $user = User::find(Auth::user()->id);
            $payload = $request->validate([
                'school_id' => 'required'
            ]);

            $payload['role'] = 'student';
            $user->update($payload);

            return response()->json([
                'success' => true,
                'message' => 'Account created successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAccount(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            return response()->json([
                'success' => true,
                'message' => 'LoggedIn User retrieved successfully',
                'data' => $user->load('school')
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function updateAccount(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            if ($request->has('interest')) {
                $user->interest = $request->interest;
            }

            if ($request->has('about')) {
                $user->about = $request->about;
            }

            if ($request->has('school_id')) {
                if(!$school = School::find($request->school_id)){
                    return response()->json(['success' => false, 'message' => 'Invalid school'], 400);
                }
                $user->school_id = $request->school_id;
            }


            if ($request->has('username')) {
                $validation = Validator::make($request->all(), [
                    'username' => 'unique:users,username'
                ]);
                if ($validation->fails()) {
                    return response()->json(['success' => false, 'message' => 'Username not available'], 400);
                }
                $user->username = $request->username;
            }

            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'Account updated and retrieved successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
