<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;
// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;

// class AuthController extends Controller
// {
//      // Login user and issue JWT
//      public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required'
//         ]);

//         $user = User::where('email', $request->email)->first();

//         if (!$user || !Hash::check($request->password, $user->password)) {
//             return back()->withErrors(['message' => 'Invalid credentials']);
//         }

//         $payload = [
//             'iss' => env('APP_URL'),
//             'sub' => $user->id,
//             'iat' => time(),
//             'exp' => time() + 60 * 60 // Token valid for 1 hour
//         ];

//         $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

//         // Automatically store the token in the user's browser as a cookie
//         cookie()->queue('jwt_token', $jwt, 60); // 60 minutes

//         return redirect('/dashboard');
//     }

//     // Logout user and clear token cookie
//     public function logout()
//     {
//         cookie()->queue(cookie()->forget('jwt_token'));
//         return redirect('/login');
//     }
//      // Get authenticated user
//     //  public function me(Request $request)
//     //  {
//     //      $token = $request->bearerToken();
 
//     //      if (!$token) {
//     //          return response()->json(['message' => 'Token not provided'], 401);
//     //      }
 
//     //      try {
//     //          $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
//     //          $user = User::find($decoded->sub);
//     //          return response()->json($user);
//     //      } catch (\Exception $e) {
//     //          return response()->json(['message' => 'Invalid token'], 401);
//     //      }
//     //  }
// }
