<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function destroy($id)
{
    $review = Review::findOrFail($id);
    $review->delete();

    return redirect()->back()->with('success', 'Review berhasil dihapus');
}
}
