<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Login
    public function showLogin()
    {
        // Jika sudah login, langsung lempar ke dashboard biar gak bisa buka halaman login lagi
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }
        
        // Asumsi file blade login ada di resources/views/auth/login.blade.php
        return view('auth.login'); 
    }

    // 2. Memproses Data Login
    public function prosesLogin(Request $request)
    {
        // Validasi inputan form
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cek kecocokan di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Jika berhasil, arahkan ke dashboard
            return redirect()->intended('/admin/dashboard');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'Username atau Password salah! Coba lagi.');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout, lempar kembali ke halaman depan / login
        return redirect('/login');
    }
}