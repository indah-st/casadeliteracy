<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('categories')->latest()->get();
        return view('admin.books.index', compact('books'));
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


    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',
            'categories' => 'required|array',
            'sinopsis' => 'nullable|string',
            'jumlah_halaman' => 'nullable|numeric',
            'cover' => 'nullable|file|image|mimes:jpeg,jpg,png,jfif|max:2048',
        ]);

        $data = $request->only([
            'judul',
            'penulis',
            'penerbit',
            'tahun',
            'stok',
            'sinopsis',
            'jumlah_halaman',
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book = Book::create($data);

        $book->categories()->sync($request->categories);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',
            'categories' => 'required|array',
            'sinopsis' => 'nullable|string',
            'jumlah_halaman' => 'nullable|numeric',
            'cover' => 'nullable|file|image|mimes:jpeg,jpg,png,jfif|max:2048',
        ]);

        $data = $request->only([
            'judul',
            'penulis',
            'penerbit',
            'tahun',
            'stok',
            'sinopsis',
            'jumlah_halaman',
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        $book->categories()->sync($request->categories);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus');
    }
}