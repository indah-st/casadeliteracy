<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use App\Models\CategoryRequest;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Review;

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
        $latestReviews = Review::with('user', 'book')->latest()->limit(5)->get();
        $latestBooks = Book::latest()->limit(6)->get();

        return view('petugas.dashboard', compact('bookRequests', 'categoryRequests', 'totalBooks', 'totalUsers', 'activeBorrowings', 'latestReviews', 'latestBooks'));
    }
}