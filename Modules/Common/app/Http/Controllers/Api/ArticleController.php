<?php

namespace Modules\Common\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    /**
     * Return published articles with optional search, school filter, and sort.
     *
     * Query params:
     *   q          – full-text search on title / content
     *   school_id  – filter to a specific school
     *   sort       – latest (default) | oldest | az
     *   per_page   – default 12
     */
    public function index(Request $request)
    {
        $perPage  = (int) $request->query('per_page', 12);
        $q        = trim($request->query('q', ''));
        $schoolId = $request->query('school_id');
        $sort     = $request->query('sort', 'latest');

        $query = Blog::with(['category', 'school'])
            ->where('status', 'PUBLISHED');

        // ── Search ────────────────────────────────────────────────────────────
        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        // ── School filter ─────────────────────────────────────────────────────
        if ($schoolId) {
            $query->where('school_id', $schoolId);
        }

        // ── Sort ──────────────────────────────────────────────────────────────
        match ($sort) {
            'oldest' => $query->oldest(),
            'az'     => $query->orderBy('title'),
            default  => $query->latest(),
        };

        $articles = $query->paginate($perPage)->appends($request->query());

        return response()->json([
            'status'  => 'success',
            'message' => 'Articles retrieved successfully',
            'data'    => $articles,
        ]);
    }

    /**
     * Return a single published article by slug or id.
     */
    public function show($slug)
    {
        $article = Blog::with(['category', 'school'])
            ->where('status', 'PUBLISHED')
            ->where(fn ($q) => $q->where('slug', $slug)->orWhere('id', $slug))
            ->firstOrFail();

        return response()->json([
            'status'  => 'success',
            'message' => 'Article retrieved successfully',
            'data'    => $article,
        ]);
    }
}
