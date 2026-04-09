<?php

namespace App\Http\Controllers;

use App\Models\Book; 
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = Book::when($search, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                         ->orWhere('penulis', 'like', '%' . $search . '%');
        })->get();
        return view('user.books', compact('books'));
    }
}
