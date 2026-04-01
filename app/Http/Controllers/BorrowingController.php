<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;

class BorrowingController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'book_id' => 'required',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after:tanggal_pinjam'
    ]);

    $book = Book::findOrFail($request->book_id);

    if ($book->stok <= 0) {
        return back()->with('error', 'Stok buku habis!');
    }

    Borrowing::create([
        'user_id' => auth()->id(),
        'book_id' => $book->id,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => 'pending'
    ]);

    return redirect()->route('borrow.history')
           ->with('success', 'Pengajuan peminjaman berhasil dikirim!');
           
}

    public function create(Book $book)
{
    return view('user.borrow-form', compact('book'));
}

public function requestReturn($id)
{
    $borrow = Borrowing::findOrFail($id);

    if ($borrow->status !== 'dipinjam') {
        return back()->with('error', 'Status tidak valid');
    }

    $borrow->status = 'menunggu_pengembalian';
    $borrow->save();

    return back()->with('success', 'Menunggu persetujuan admin');
}

public function approveReturn($id)
{
    $borrow = Borrowing::findOrFail($id);

    if ($borrow->status !== 'menunggu_pengembalian') {
        return back()->with('error', 'Belum ada pengajuan pengembalian');
    }

    $borrow->status = 'selesai';
    $borrow->save();

    // BALIKIN STOK
    $borrow->book->increment('stok');

    return back()->with('success', 'Pengembalian disetujui');
}

public function rejectReturn($id)
{
    $borrow = Borrowing::findOrFail($id);

    if ($borrow->status !== 'menunggu_pengembalian') {
        return back()->with('error', 'Tidak bisa ditolak');
    }

    $borrow->status = 'dipinjam';
    $borrow->save();

    return back()->with('error', 'Pengembalian ditolak');
}

public function history()
{
    $borrowings = Borrowing::with('book')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('user.profile', compact('borrowings'));
}
}
