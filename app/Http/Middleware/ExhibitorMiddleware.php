<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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

            if (in_array($request->path(), ['exhibitor/profile/create', 'exhibitor/profile/store'])) {
                return $next($request);
            }

            if (!Auth::user()->exhibitor) {
                return redirect('/exhibitor/profile/create');
            }

            return $next($request);
        }

        return redirect('/');
    }
}
