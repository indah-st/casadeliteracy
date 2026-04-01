<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
       $books = Book::with('categories')->latest()->get();
        return view('books.index', compact('books'));
    }

    // Dashboard user
    public function dashboard()
{
    $books = Book::with('categories')->latest()->get();
    return view('user.dashboard', compact('books'));
}

    // Tambah ke koleksi user
    public function addToCollection(Book $book)
{
    $user = Auth::user();

    $user->books()->syncWithoutDetaching($book->id);

    return redirect()->route('user.collections.index')
        ->with('success', 'Buku berhasil ditambahkan ke koleksi!');
}

    // Pinjam buku
    public function borrow(Book $book)
    {
        $user = Auth::user();
        $user->borrowings()->create([
            'book_id' => $book->id,
            'status' => 'pending',
        ]);
        return back()->with('success', 'Berhasil meminjam buku!');
    }

    public function create()
{
    $categories = Category::all();
    return view('books.create', compact('categories'));
}

   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun' => 'required|integer',
        'stok' => 'required|integer',
        'sinopsis' => 'nullable|string',
        'jumlah_halaman' => 'nullable|integer',
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->only([
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
        'sinopsis',
        'jumlah_halaman'
    ]);

    if ($request->hasFile('cover')) {
        $cover = $request->file('cover');
        $coverName = time().'.'.$cover->getClientOriginalExtension();
        $cover->move(public_path('covers'), $coverName);
        $data['cover'] = $coverName;
    }

    $book = Book::create($data);

    $book->categories()->sync($request->categories);

    return redirect()->route('admin.books.index')
        ->with('success','Buku berhasil ditambahkan');
}

    public function show(Book $book)
    {
        $book->load(['reviews.user', 'categories']);
        return view('user.book-detail', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book','categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|integer',
            'stok' => 'required|integer',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if($request->hasFile('cover')){
            if($book->cover && file_exists(public_path('covers/'.$book->cover))){
                unlink(public_path('covers/'.$book->cover));
            }
            $cover = $request->file('cover');
            $coverName = time().'.'.$cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
            $data['cover'] = $coverName;
        }

        $book->update($data);

        $book->categories()->sync($request->categories);
        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate!');
    }

    public function destroy(Book $book)
    {
        if($book->cover && file_exists(public_path('covers/'.$book->cover))){
            unlink(public_path('covers/'.$book->cover));
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
