<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // If user is authenticated and has the required role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Redirect if user doesn't have permission
        return redirect('/')->with('error', 'You do not have access to this section');
    }
}
