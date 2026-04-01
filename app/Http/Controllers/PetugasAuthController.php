<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;

class PetugasAuthController extends Controller
{
    // FORM LOGIN
    public function showLogin() {
        return view('petugas.login');
    }

    // PROSES LOGIN
    public function login(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $credentials = $request->only('email','password');

        if (Auth::guard('petugas')->attempt($credentials)) {
            return redirect()->route('petugas.dashboard');
        }

        return back()->withErrors(['email'=>'Email atau password salah']);
    }

    // LOGOUT
    public function logout() {
        Auth::guard('petugas')->logout();
        return redirect()->route('petugas.petugas.login');
    }
}