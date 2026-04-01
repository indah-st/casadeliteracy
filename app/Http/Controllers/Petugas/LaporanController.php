<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;

class LaporanController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'selesai')
            ->latest()
            ->get();

        return view('petugas.laporan.index', compact('borrowings'));
    }

    public function print($id)
    {
        $borrowing = Borrowing::with(['user', 'book'])->findOrFail($id);
        return view('petugas.laporan.print', compact('borrowing'));
    }
}
