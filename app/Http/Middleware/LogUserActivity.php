<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Before the request is handled, log user activity
        if (Auth::check()) {
            $user = Auth::user();
            $action = $request->method() . ' ' . $request->path();  // HTTP method and path
            $ip = $request->ip();  // Get the user's IP address

            // Log the activity to a file
            Log::info('User Activity:', [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'action' => $action,
                'ip_address' => $ip,
                'timestamp' => now(),
            ]);
        }

        // Continue the request
        return $next($request);
    }
}
