<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Book;
use App\Models\BookRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('categories')->latest()->get();
        $bookRequests = BookRequest::where('user_id', $this->currentActorId())->latest()->get();

        return view('petugas.books.index', compact('books', 'bookRequests'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('petugas.books.create', compact('categories'));
    }

    protected function currentActorRole()
    {
        if (Auth::guard('web')->check() && Auth::user()) {
            return Auth::user()->role ?? 'admin';
        }

        if (Auth::guard('petugas')->check()) {
            return 'petugas';
        }

        return 'guest';
    }

    protected function currentActorId()
    {
        return Auth::guard('web')->id() ?? Auth::guard('petugas')->id();
    }

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
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,jfif|max:2048'
        ]);

        BookRequest::create([
            'user_id' => $this->currentActorId(),
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

        return redirect()->route('petugas.book_requests.index')
            ->with('success', 'Request penambahan buku berhasil dikirim, menunggu approval admin (pending)');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('petugas.books.edit', compact('book','categories'));
    }

    public function update(Request $request, Book $book)
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
            'user_id' => $this->currentActorId(),
            'book_id' => $book->id,
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'stok' => $request->stok,
            'sinopsis' => $request->sinopsis,
            'jumlah_halaman' => $request->jumlah_halaman,
            'cover' => $request->cover,
            'action' => 'update',
            'status' => 'pending',
        ]);

        return redirect()->route('petugas.book_requests.index')
            ->with('success', 'Request update buku berhasil dikirim, menunggu approval admin (pending)');
    }

    public function destroy(Book $book)
    {
        BookRequest::create([
            'user_id' => $this->currentActorId(),
            'book_id' => $book->id,
            'judul' => $book->judul,
            'penulis' => $book->penulis,
            'category_id' => $book->categories()->first()?->id,
            'action' => 'delete',
            'status' => 'pending',
        ]);

        return redirect()->route('petugas.book_requests.index')
            ->with('success', 'Request hapus buku berhasil dikirim, menunggu approval admin (pending)');
    }
}