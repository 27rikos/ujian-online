<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        // Validasi input pengguna
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Mendapatkan credentials dari request
        $credentials = $request->only('email', 'password');

        // Coba autentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi setelah autentikasi untuk mencegah session fixation
            $request->session()->regenerate();

            // Redirect berdasarkan role pengguna
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/dashboard');
                case 'dosen':
                    return redirect()->intended('/dashboard-dosen');
                case 'mahasiswa':
                    return redirect()->intended('/dashboard-mahasiswa');
                default:
                    // Jika role tidak diketahui, redirect ke halaman utama
                    return redirect()->intended('/');
            }
        }
        return back()->with('toast_error', 'username/password salah');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}