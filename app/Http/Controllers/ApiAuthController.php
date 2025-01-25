<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (JWTAuth::attempt($credentials)) {
            $user = Auth::user();

            $payload = [
                'iss' => env('APP_URL'),
                'sub' => $user->id,
                'iat' => time(),
                'exp' => time() + 60 * 60, // Token berlaku selama 1 jam
            ];

            $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

            return response()->json(['token' => $jwt]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        // JWT logout: Tidak ada mekanisme logout di JWT, cukup abaikan token di klien
        return response()->json(['message' => 'Successfully logged out']);
    }
}
