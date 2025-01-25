<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    /**
     * Handle the login process.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Ambil email dan password dari request
        $credentials = $request->only('email', 'password');

        // Attempt login
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk mencegah session fixation attacks
            $request->session()->regenerate();

            // Redirect ke halaman dashboard atau intended URL
            return redirect()->intended('/dashboard');
        }

        // Jika gagal login, kembali ke halaman login dengan error
        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ])->onlyInput('email'); // Mengembalikan input email
    }

    /**
     * Handle the logout process.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate sesi
        $request->session()->invalidate();

        // Regenerate token untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login');
    }
}
