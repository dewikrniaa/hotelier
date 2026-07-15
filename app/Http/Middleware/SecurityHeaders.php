<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Security Headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Referrer-Policy', 'no-referrer');

        // Content Security Policy (CSP)
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; img-src 'self' data:; script-src 'self'; style-src 'self';"
        );

        return $response;
    }
}
