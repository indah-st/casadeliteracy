<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\BookRequest;
use App\Models\CategoryRequest;

class ApprovalController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user','book'])
            ->whereIn('status', ['pending', 'menunggu_pengembalian'])
            ->latest()
            ->get();

        return view('petugas.approvals.index', compact('borrowings'));
    }

    // ✅ APPROVE PINJAM
    public function approve($id)
    {
        $b = Borrowing::findOrFail($id);

        $b->status = 'dipinjam';
        $b->save();

        return back()->with('success', 'Peminjaman disetujui');
    }

    // ❌ REJECT PINJAM
    public function reject($id)
    {
        $b = Borrowing::findOrFail($id);

        $b->status = 'ditolak';
        $b->save();

        return back()->with('success', 'Peminjaman ditolak');
    }

    // ✅ APPROVE RETURN
    public function approveReturn($id)
    {
        $b = Borrowing::findOrFail($id);

        $b->status = 'selesai';
        $b->save();

        // BALIKIN STOK
        $book = Book::find($b->book_id);
        if ($book) {
            $book->stok += 1;
            $book->save();
        }

        return back()->with('success', 'Pengembalian disetujui');
    }

    // ❌ REJECT RETURN
    public function rejectReturn($id)
    {
        $b = Borrowing::findOrFail($id);

        $b->status = 'dipinjam';
        $b->save();

        return back()->with('success', 'Pengembalian ditolak');
    }
}
