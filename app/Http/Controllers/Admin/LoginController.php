<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id'        => $admin->id_admin,
                'admin_username'  => $admin->username,
                'admin_role'      => $admin->role,
            ]);
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang, ' . $admin->username . '!');
        }

        return back()->withErrors(['login' => 'Username atau password salah.'])->withInput(['username' => $request->username]);
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_username', 'admin_role']);
        return redirect()->route('admin.login')->with('success', 'Anda telah keluar dari sistem.');
    }
}
