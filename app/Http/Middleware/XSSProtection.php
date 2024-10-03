<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;

class XSSProtection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Recursively sanitize input fields
        $this->clean($request);

        return $next($request);
    }

    /**
     * Recursively sanitize input fields by removing script tags and malicious content.
     */
    private function clean($request)
    {
        $input = $request->all();
        array_walk_recursive($input, function (&$input) {
            // Strip out any script tags or dangerous content
            $input = strip_tags($input);
        });

        $request->merge($input);
    }
}
