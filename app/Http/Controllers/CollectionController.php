<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function index()
    {
        $books = Auth::user()->books;

        return view('user.collections.index', compact('books'));
    }
}
