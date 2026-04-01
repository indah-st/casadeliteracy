<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRequest;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    // Halaman buat nambah request buku
    public function create()
    {
        // Ambil semua book request milik petugas yang login
        $bookRequests = BookRequest::where('user_id', Auth::id())->latest()->get();
        $categories = \App\Models\Category::all();

        return view('petugas.book_requests.create', compact('bookRequests', 'categories'));
    }

 public function index()
    {
        // ambil semua book request milik user yang login
        $bookRequests = BookRequest::where('user_id', Auth::id())->get();

        return view('petugas.book_requests.index', compact('bookRequests'));
    }
    
    // Simpan request baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'sinopsis' => 'nullable|string',
            'jumlah_halaman' => 'nullable|numeric',
            'cover' => 'nullable|string',
        ]);

        BookRequest::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'stok' => $request->stok,
            'sinopsis' => $request->sinopsis,
            'jumlah_halaman' => $request->jumlah_halaman,
            'cover' => $request->cover,
            'action' => 'create',
            'status' => 'pending',
        ]);

        return redirect()->route('petugas.book_requests.create')
            ->with('success', 'Request buku berhasil dibuat!');
    }  
}