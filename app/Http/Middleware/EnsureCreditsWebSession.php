<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Protects the credits top-up POST/callback routes. The signed `credits.web.show`
 * link is the only entry point — visiting it plants `credits_web_user_id` in the
 * session, which this middleware then requires for the follow-up actions, instead
 * of needing a second signature (see CreditsWebController).
 */
class EnsureCreditsWebSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('credits_web_user_id')) {
            return response()->view('pages.credits-topup-expired', [], 403);
        }

        return $next($request);
    }
}
