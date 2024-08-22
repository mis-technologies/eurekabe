<?php

namespace Modules\Advocate\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Models\School;

class AdvocateSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $schools = $user->schools;
        return response()->json([
            'success' => true,
            'message' => "Schools retrieved",
            'data' => $schools,
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'nullable|string',
            'acronym' => 'nullable|string|max:10',
            'year' => 'nullable|integer',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'rank' => 'nullable|integer',
            'logo' => 'nullable|url',
            'cover_image' => 'nullable|url',
            'is_active' => 'required|boolean',
        ]);

        $school = School::create($validated);

        $user = User::find(Auth::user()->id);
        $school->users()->attach($user->id, ['role' => 'advocate']);
        
        return response()->json([
            'success' => true,
            'message' => "school created",
            'data' => $school,
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $school = School::findOrFail($id);

       

        return response()->json([
            'success' => true,
            'message' => "School retrieved",
            'data' => $school,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $school = School::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'nullable|string',
            'acronym' => 'nullable|string|max:10',
            'year' => 'nullable|integer',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'rank' => 'nullable|integer',
            'logo' => 'nullable|url',
            'cover_image' => 'nullable|url',
            'is_active' => 'required|boolean',
        ]);

        $school->update($validated);

        return response()->json($school);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
