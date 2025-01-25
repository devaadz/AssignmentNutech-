<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Tymon\JWTAuth\Contracts\JWTSubject;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken(); // Ambil token dari header Authorization
        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $request->attributes->set('user_id', $decoded->sub); // Simpan user ID ke request
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    }
}
