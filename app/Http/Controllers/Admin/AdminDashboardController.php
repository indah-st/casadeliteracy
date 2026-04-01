<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ✅ harus ada
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Book::count();
        $totalUser = User::where('role', 'user')->count(); // asumsi role 'user'
        $totalPetugas = User::where('role', 'petugas')->count(); // asumsi role 'petugas'
        $peminjamanAktif = Borrowing::where('status', 'dipinjam')->count(); // status aktif

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalUser',
            'totalPetugas',
            'peminjamanAktif'
        ));
    }
}