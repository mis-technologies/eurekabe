<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UpdateLastSeen
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $userId   = Auth::id();
            $cacheKey = "last_seen:{$userId}";

            // Rate-limit DB writes — at most once per 60 seconds per user
            if (!Cache::has($cacheKey)) {
                Auth::user()->updateQuietly(['last_seen_at' => now()]);
                Cache::put($cacheKey, true, 60);
            }
        }

        return $response;
    }
}
