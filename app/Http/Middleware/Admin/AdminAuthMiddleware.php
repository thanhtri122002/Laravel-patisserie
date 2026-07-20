<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     * This is a middleware which verifies a request whether it contains admin_token ornot
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $token = $request->cookie('admin_token');
        
        if(!$token) {
            return response()->json(['message' => "Token is missing"], 401);
        }
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken || !$accessToken->tokenable) {
            return response()->json(['message' => 'Invalid or expired token'], 401);
        }
        $request->setUserResolver(fn () => $accessToken->tokenable);
        
        return $next($request);
    }
}
