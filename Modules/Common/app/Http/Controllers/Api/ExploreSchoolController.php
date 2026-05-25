<?php

namespace Modules\Common\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Common\Models\School;
use Illuminate\Http\Request;

class ExploreSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize query builder for School
        $query = School::query();

        // Filtering (e.g., by acronym, state, or city)
        if ($request->has('acronym')) {
            $query->where('acronym', $request->get('acronym'));
        }

        if ($request->has('state')) {
            $query->where('state', $request->get('state'));
        }

        if ($request->has('city')) {
            $query->where('city', $request->get('city'));
        }

        // Searching (e.g., search by name or description)
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('about', 'like', "%{$search}%");
            });
        }

        // Sorting
        if ($request->has('sort_by') && in_array($request->get('sort_by'), ['name', 'created_at'])) {
            $sortOrder = $request->get('sort_order', 'asc'); // default to ascending order
            $query->orderBy($request->get('sort_by'), $sortOrder);
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $schools = $query->paginate($perPage);

        $user = auth('sanctum')->user();
        if ($user) {
            $userSchoolId = $user->school_id;
            $followerSchoolIds = $user->schools()->pluck('schools.id')->toArray();
            
            $schools->getCollection()->transform(function($school) use ($userSchoolId, $followerSchoolIds) {
                $school->is_affiliated = ($school->id === $userSchoolId);
                $school->is_follower = in_array($school->id, $followerSchoolIds);
                return $school;
            });
        } else {
            $schools->getCollection()->transform(function($school) {
                $school->is_affiliated = false;
                $school->is_follower = false;
                return $school;
            });
        }

        // Return API response
        return response()->json([
            'success' => true,
            'data' => $schools,
        ], 200);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        // Retrieve the school by ID
        $school = School::where('id', $id)->orWhere('acronym', $id)->first();

        // Check if school exists
        if (!$school) {
            return response()->json([
                'success' => false,
                'message' => 'School not found.',
            ], 404);
        }

        // Determine affiliation and following status
        $is_affiliated = false;
        $is_follower = false;

        $user = auth('sanctum')->user();
        if ($user) {
            $is_affiliated = ($user->school_id === $school->id);
            $is_follower = $user->schools()->where('schools.id', $school->id)->exists();
        }

        $school->is_affiliated = $is_affiliated;
        $school->is_follower = $is_follower;

        // Return the school data
        return response()->json([
            'success' => true,
            'data' => $school,
        ], 200);
    }

    public function follow(Request $request, $id)
    {
        $school = School::where('id', $id)->orWhere('acronym', $id)->first();
        if (!$school) {
            return response()->json(['success' => false, 'message' => 'School not found.'], 404);
        }

        $user = auth('sanctum')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401);
        }

        if ($user->schools()->where('schools.id', $school->id)->exists()) {
            $user->schools()->detach($school->id);
            $is_follower = false;
        } else {
            $user->schools()->attach($school->id, ['role' => 'follower']);
            $is_follower = true;
        }

        return response()->json([
            'success' => true,
            'is_follower' => $is_follower,
            'message' => $is_follower ? 'You are now following this school.' : 'You have unfollowed this school.',
        ], 200);
    }
}
