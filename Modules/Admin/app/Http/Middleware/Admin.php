<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check() || Auth::user()->role != 'admin') {
            return redirect()->route('admin.login');

        }
        return $next($request);
    }
}
