<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * TrackUserActivity Middleware
 * 
 * Demonstrates:
 * 1. Session Usage: Updates 'last_activity' timestamp in user session.
 * 2. Cookie Usage: Queues a client-readable cookie 'user_last_active_time' with the current datetime.
 * 3. Proper Commenting: Clear documentation of session/cookie behavior.
 */
class TrackUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Session Implementation: Store current ISO timestamp in the user's session
        $request->session()->put('last_activity', now()->toIso8601String());

        // Proceed to process the request
        $response = $next($request);

        // 2. Cookie Implementation: Attach an unencrypted cookie that JS can read
        // Note: Laravel encrypts cookies by default. We can use a standard cookie
        // and allow it to be decrypted or read. But to make it easily readable by JS,
        // we can either add it to the EncryptCookies middleware exception list
        // or just set a standard cookie. Let's register it so it is excluded from encryption.
        $response->headers->setCookie(
            cookie('user_last_active_time', now()->format('Y-m-d H:i:s'), 60, null, null, false, false)
        );

        return $response;
    }
}
