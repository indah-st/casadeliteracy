<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequestController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('petugas')->id();
        $data = CategoryRequest::where('user_id', $userId)->latest()->get();
        return view('petugas.category_request.index', compact('data'));
    }

    public function create(Request $request)
    {
        $action = $request->get('action', 'create');
        $category = null;
        if ($action !== 'create') {
            $category = \App\Models\Category::find($request->get('category_id'));
        }
        return view('petugas.category_request.create', compact('action', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $action = $request->get('action', 'create');

        $userId = Auth::guard('petugas')->id();

        CategoryRequest::create([
            'user_id' => $userId,
            'name' => $request->name,
            'action' => $action,
            'category_id' => $request->get('category_id'),
            'status' => 'pending'
        ]);

        return redirect()
            ->route('petugas.category_requests.index')
            ->with('success', 'Request kategori berhasil dikirim!');
    }
}