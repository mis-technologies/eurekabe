<?php

namespace Modules\Common\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    /**
     * Return published articles, newest first, with category eager-loaded.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);

        $articles = Blog::with('category')
            ->where('status', 'PUBLISHED')
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'status'  => 'success',
            'message' => 'Articles retrieved successfully',
            'data'    => $articles,
        ]);
    }

    /**
     * Return a single published article.
     */
    public function show($slug)
    {
        $article = Blog::with('category')
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
