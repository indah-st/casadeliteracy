<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // FORM REGISTER USER
    public function showRegister()
    {
        return view('auth.register');
    }

    // PROSES REGISTER USER
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user' // FIX: default selalu user
        ]);

        // langsung arahkan ke login user
        return redirect('/login')->with('success', 'Register berhasil, silakan login!');
    }

    // FORM LOGIN USER
    public function showLogin()
    {
        return view('auth.login');
    }

    // PROSES LOGIN (USER / PETUGAS / ADMIN BISA LEWAT SINI TAPI LU NANTI PISAH)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = auth()->user()->role;

            // arahkan sesuai role
            if ($role === 'admin') {
                return redirect('/admin/dashboard');
            } 
            elseif ($role === 'petugas') {
                return redirect('/petugas/dashboard');
            } 
            else {
                return redirect('/user/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // LOGOUT SEMUA ROLE
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // balik ke landing, bukan ke login biar rapi
        return redirect('/');
    }
}
