<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use App\Models\Borrowing;
use App\Models\CategoryRequest;
use App\Models\Book;
use App\Models\Category;

class ApprovalController extends Controller
{
    // 📚 LIST SEMUA REQUEST (Admin)
    public function index()
    {
        $borrowings = Borrowing::latest()->get();
        $bookRequests = BookRequest::latest()->get();
        $categoryRequests = CategoryRequest::latest()->get();
        $approvals = \App\Models\Approval::latest()->get();

        return view('admin.approvals.index', compact(
            'borrowings',
            'bookRequests',
            'categoryRequests',
            'approvals'
        ));
    }

    // ✅ APPROVE BUKU REQUEST
    public function approveBook($id)
    {
        $req = BookRequest::findOrFail($id);

        if ($req->status !== 'pending') {
            return back()->with('info', 'Request buku sudah diproses.');
        }

        if ($req->action === 'create') {
            $book = Book::create([
                'judul' => $req->judul,
                'penulis' => $req->penulis,
                'penerbit' => $req->penerbit,
                'tahun' => $req->tahun,
                'stok' => $req->stok,
                'sinopsis' => $req->sinopsis,
                'jumlah_halaman' => $req->jumlah_halaman,
                'cover' => $req->cover,
            ]);

            if ($req->category_id) {
                $book->categories()->sync([$req->category_id]);
            }
        } elseif ($req->action === 'update') {
            $book = Book::findOrFail($req->book_id);
            $book->update([
                'judul' => $req->judul,
                'penulis' => $req->penulis,
                'penerbit' => $req->penerbit,
                'tahun' => $req->tahun,
                'stok' => $req->stok,
                'sinopsis' => $req->sinopsis,
                'jumlah_halaman' => $req->jumlah_halaman,
                'cover' => $req->cover,
            ]);

            if ($req->category_id) {
                $book->categories()->sync([$req->category_id]);
            }
        } elseif ($req->action === 'delete') {
            $book = Book::find($req->book_id);
            if ($book) {
                $book->delete();
            }
        }

        $req->update(['status' => 'approved']);

        return back()->with('success', 'Request buku berhasil disetujui dan diproses.');
    }

    // ❌ REJECT BUKU REQUEST
    public function rejectBook($id)
    {
        $req = BookRequest::findOrFail($id);
        $req->update(['status' => 'rejected']);

        return back()->with('success', 'Request buku ditolak.');
    }

    // ✅ APPROVE KATEGORI REQUEST
    public function approveCategory($id)
    {
        $req = CategoryRequest::findOrFail($id);

        if ($req->status !== 'pending') {
            return back()->with('info', 'Request kategori sudah diproses.');
        }

        if ($req->action === 'create') {
            Category::create(['name' => $req->name]);
        } elseif ($req->action === 'update') {
            $category = Category::findOrFail($req->category_id);
            $category->update(['name' => $req->name]);
        } elseif ($req->action === 'delete') {
            $category = Category::find($req->category_id);
            if ($category) {
                $category->delete();
            }
        }

        $req->update(['status' => 'approved']);

        return back()->with('success', 'Request kategori berhasil disetujui dan diproses.');
    }

    // ❌ REJECT KATEGORI REQUEST
    public function rejectCategory($id)
    {
        $req = CategoryRequest::findOrFail($id);
        $req->update(['status' => 'rejected']);

        return back()->with('success', 'Request kategori ditolak.');
    }
}