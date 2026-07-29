<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Request;
// use Illuminate\Support\Facades\Schedule;
use Illuminate\Console\Scheduling\Schedule; // Corrected import


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        // channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withBroadcasting(
        __DIR__.'/../routes/channels.php',
        ['prefix' => 'api', 'middleware' => ['api', 'auth:sanctum']],
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('api', \App\Http\Middleware\UpdateLastSeen::class);
    })
    ->withSchedule(function (Schedule $schedule) {
        // Reset monthly credit allowances for accounts whose next_reset_at is past
        $schedule->command('credits:monthly-reset')->daily();

        // Auto-renew monthly subscriptions using stored card authorizations
        $schedule->command('credits:renew-subscriptions')->daily();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if (str_starts_with($request->getPathInfo(), '/api/')) {
                return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
            }
        });
    })->create();
