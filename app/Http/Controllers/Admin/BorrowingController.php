<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->get();

        return view('admin.peminjaman.index', compact('borrowings'));
    }

    // ✅ APPROVE PEMINJAMAN
    public function approve($id)
    {
        $borrow = Borrowing::findOrFail($id);

        if ($borrow->status !== 'pending') {
            return back()->with('error', 'Status tidak valid');
        }

        $borrow->status = 'dipinjam';
        $borrow->save();

        // 🔥 kurangi stok
        $borrow->book->decrement('stok');

        return back()->with('success', 'Peminjaman disetujui');
    }

    // ❌ REJECT PEMINJAMAN
    public function reject($id)
    {
        $borrow = Borrowing::findOrFail($id);

        if ($borrow->status !== 'pending') {
            return back()->with('error', 'Tidak bisa ditolak');
        }

        $borrow->status = 'ditolak';
        $borrow->save();

        return back()->with('success', 'Peminjaman ditolak');
    }

    // 🔄 APPROVE RETURN
    public function approveReturn($id)
    {
        $borrow = Borrowing::findOrFail($id);

        if ($borrow->status !== 'menunggu_pengembalian') {
            return back()->with('error', 'Belum ada pengajuan pengembalian');
        }

        $borrow->status = 'selesai';
        $borrow->save();

        // 🔥 tambah stok
        $borrow->book->increment('stok');

        return back()->with('success', 'Pengembalian disetujui');
    }

    // ❌ REJECT RETURN
    public function rejectReturn($id)
    {
        $borrow = Borrowing::findOrFail($id);

        if ($borrow->status !== 'menunggu_pengembalian') {
            return back()->with('error', 'Tidak bisa ditolak');
        }

        $borrow->status = 'dipinjam';
        $borrow->save();

        return back()->with('success', 'Pengembalian ditolak');
    }

    // 📄 LAPORAN
    public function laporan()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'selesai')
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('borrowings'));
    }

    public function print($id)
    {
        $borrowing = Borrowing::with(['user', 'book'])->findOrFail($id);
        return view('admin.laporan.print', compact('borrowing'));
    }

    public function printAll()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'selesai')
            ->latest()
            ->get();

        return view('admin.laporan.print_all', compact('borrowings'));
    }
}