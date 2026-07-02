<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     * Requires login first (should be combined with 'auth' middleware),
     * then redirects non-admins back to their own dashboard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== 'admin') {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
