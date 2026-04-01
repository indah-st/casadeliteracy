<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use App\Models\CategoryRequest;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->guard('petugas')->id();

        $bookRequests = BookRequest::where('user_id', $userId)->latest()->get();
        $categoryRequests = CategoryRequest::where('user_id', $userId)->latest()->get();

        $totalBooks = Book::count();
        $totalUsers = User::count();
        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();

        return view('petugas.dashboard', compact('bookRequests', 'categoryRequests', 'totalBooks', 'totalUsers', 'activeBorrowings'));
    }
}