<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// Allow only authenticated exhibitor users to access exhibitor routes.
// Enforces that exhibitors must have a profile before proceeding.
class ExhibitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'exhibitor') {

            // Allow access to profile creation routes without a profile.
            if (in_array($request->path(), ['exhibitor/profile/create', 'exhibitor/profile/store'])) {
                return $next($request);
            }

            // Redirect to profile creation if no exhibitor profile exists yet.
            if (!Auth::user()->exhibitor) {
                return redirect('/exhibitor/profile/create');
            }

            return $next($request);
        }

        // Redirect non-exhibitor users to the homepage.
        return redirect('/');
    }
}
