<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Book $book)
    {
        return view('user.reviews.create', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        $request->validate([
            'komentar' => 'required|string',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'komentar' => $request->komentar,
            'rating' => $request->rating,
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Review berhasil ditambahkan!');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review berhasil dihapus!');
    }
}