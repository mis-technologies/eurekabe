<?php

namespace Modules\Explore\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Common\Models\Student;

class ExploreStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize query builder for School
        $query = User::query();
       
        // Searching (e.g., search by name or description)
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%");
            });
        }

        // Sorting
        if ($request->has('sort_by') && in_array($request->get('sort_by'), ['name', 'created_at'])) {
            $sortOrder = $request->get('sort_order', 'asc'); // default to ascending order
            $query->orderBy($request->get('sort_by'), $sortOrder);
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $students = $query->with('school')->paginate($perPage);

        // Return API response
        return response()->json([
            'success' => true,
            'data' => $students,
        ], 200);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        // Retrieve the school by ID
        $student = User::where('id', $id)->first();

        // Check if school exists
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
            ], 404);
        }

        // Return the school data
        return response()->json([
            'success' => true,
            'data' => $student,
        ], 200);
    }
}
