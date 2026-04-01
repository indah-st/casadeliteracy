<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrowing;

class ProfileController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $borrowings = Borrowing::with('book')
        ->where('user_id', $user->id)
        ->latest()
        ->get();

    return view('user.profile', compact('user','borrowings'));
}

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email'
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile berhasil diupdate!');
    }
    
}