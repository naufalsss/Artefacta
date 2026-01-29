<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // =====================
    // SHOW LOGIN FORM
    // =====================
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // =====================
    // DAFTAR
    // =====================
    public function daftar(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|integer|min:1|max:120',
            'status' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $data['name'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'umur' => $data['umur'],
            'status' => $data['status'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route('login'),
            'message' => 'Akun berhasil dibuat'
        ]);

    }

    // =====================
    // LOGIN
    // =====================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
