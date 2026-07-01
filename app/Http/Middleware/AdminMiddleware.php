<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// Allow only authenticated admin users to access admin routes.
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Proceed if the user is logged in and has the admin role.
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redirect everyone else to the homepage.
        return redirect('/');
    }
}
