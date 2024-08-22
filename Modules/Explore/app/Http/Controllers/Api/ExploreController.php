<?php

namespace Modules\Explore\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Common\Models\School;
use Illuminate\Http\Request;

class ExploreController extends Controller
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

        // Return API response
        return response()->json([
            'success' => true,
            'data' => $schools,
        ], 200);
    }

   
}
