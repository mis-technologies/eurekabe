<?php

namespace Modules\Advocate\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdvocateAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // First check Sanctum authentication
        if (!Auth::check()) {
            return redirect()->route('advocate.login');
        }

        // Check if the authenticated user is an advocate
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return redirect()->route('advocate.login');
        }
        if (!$user->isAdvocate()) {
            return redirect()->route('advocate.login');
        }

        return $next($request);
    }
}
