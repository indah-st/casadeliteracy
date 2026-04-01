<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $userId = Auth::guard('petugas')->id();
        $requestLogs = CategoryRequest::where('user_id', $userId)->latest()->get();

        return view('petugas.categories.index', compact('categories', 'requestLogs'));
    }

    public function create()
    {
        return view('petugas.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $userId = Auth::guard('petugas')->id();

        CategoryRequest::create([
            'user_id' => $userId,
            'name' => $request->name,
            'action' => 'create',
            'status' => 'pending',
        ]);

        return redirect()->route('petugas.categories.index')
            ->with('success', 'Request kategori berhasil dikirim, menunggu approval admin');
    }

    public function edit(Category $category)
    {
        return view('petugas.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255']);

        CategoryRequest::create([
            'user_id' => Auth::id(),
            'category_id' => $category->id,
            'name' => $request->name,
            'action' => 'update',
            'status' => 'pending',
        ]);

        return redirect()->route('petugas.categories.index')
            ->with('success', 'Request update kategori dikirim, menunggu approval admin');
    }

    public function destroy(Category $category)
    {
        CategoryRequest::create([
            'user_id' => Auth::id(),
            'category_id' => $category->id,
            'name' => $category->name,
            'action' => 'delete',
            'status' => 'pending',
        ]);

        return redirect()->route('petugas.categories.index')
            ->with('success', 'Request hapus kategori dikirim, menunggu approval admin');
    }
}
