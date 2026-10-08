<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * Blocks a logged-in user from reaching a dashboard/route that does not
     * belong to their assigned role — including direct URL access — and
     * sends them to a 403 Access Denied page instead.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! in_array($user->role, $roles, true)) {
            abort(403, 'Access Denied. You do not have permission to view this page.');
        }

        return $next($request);
    }
}
