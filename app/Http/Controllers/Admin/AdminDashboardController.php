<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ✅ harus ada
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Book::count();
        $totalUser = User::where('role', 'user')->count(); // asumsi role 'user'
        $totalPetugas = User::where('role', 'petugas')->count(); // asumsi role 'petugas'
        $peminjamanAktif = Borrowing::where('status', 'dipinjam')->count(); // status aktif
        $latestReviews = Review::with('user', 'book')->latest()->limit(5)->get();
        $latestBooks = Book::latest()->limit(6)->get();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalUser',
            'totalPetugas',
            'peminjamanAktif',
            'latestReviews',
            'latestBooks'
        ));
    }
}