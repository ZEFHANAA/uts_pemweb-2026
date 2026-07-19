<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Add baseline security headers to every response.
 *
 * Headers applied:
 *   X-Content-Type-Options: nosniff
 *   X-Frame-Options: SAMEORIGIN
 *   Strict-Transport-Security: max-age=31536000; includeSubDomains
 *   Referrer-Policy: strict-origin-when-cross-origin
 *   Permissions-Policy: camera=(), microphone=(), geolocation=(), interest-cohort=()
 *
 * ponytail: no CSP yet — enabled via config/permissions.php when ready.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), interest-cohort=()');

        return $response;
    }
}
