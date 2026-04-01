<?php

namespace App\Http\Controllers;

use App\Models\Book; 

class UserBookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('user.books', compact('books'));
    }
}
