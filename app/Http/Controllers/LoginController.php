<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Menampilkan halaman login
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    // 2. Proses memvalidasi login
    public function authenticate(Request $request)
    {
        // Validasi inputan
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        // Cek ke Database (Magic-nya Laravel ada di sini)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Aman dari hacking session fixation

            return redirect()->intended('/'); // Kalau sukses, lempar ke home
        }

        // Kalau gagal
        return back()->with('loginError', 'Login gagal! Email atau Password salah.');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}