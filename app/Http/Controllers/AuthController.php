<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name'           => 'required',
            'email'          => 'required|email|unique:users',
            'password'       => 'required|min:6',
            'city'           => 'required|string|in:Jakarta Pusat,Jakarta Selatan,Jakarta Barat,Jakarta Utara,Jakarta Timur',
            'address_detail' => 'required|string|max:255'
        ], [
            'city.in' => 'Maaf, registrasi hanya diperbolehkan untuk pengguna yang berlokasi di wilayah Jakarta (Jakarta Pusat, Jakarta Utara, Jakarta Timur, Jakarta Selatan, Jakarta Barat). Lokasi perpustakaan kami berada di Jakarta Pusat.',
        ]);

        $addressLower = strtolower($request->address_detail);
        $allowedKeywords = [
            'jakarta pusat',
            'jakarta selatan',
            'jakarta barat',
            'jakarta utara',
            'jakarta timur',
            'jakarta',
        ];

        if (! Str::contains($addressLower, $allowedKeywords)) {
            return back()
                ->withErrors(['address_detail' => 'Maaf, lokasi Anda tidak sesuai.'])
                ->withInput();
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'address'  => trim($request->city . ', ' . $request->address_detail),
            'role'     => 'user'
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
