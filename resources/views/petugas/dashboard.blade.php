@extends('layouts.app-dashboardstaff')

@section('content')

<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Selamat datang, {{ Auth::guard('petugas')->user()->nama ?? 'Petugas' }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Buku</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalBooks }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total User</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Peminjaman Aktif</h3>
            <p class="text-3xl font-bold text-red-600">{{ $activeBorrowings }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Book Requests</h2>
            <ul>
                @forelse($bookRequests as $request)
                    <li class="mb-2">{{ $request->title ?? 'Judul kosong' }} - <span class="text-sm text-gray-500">{{ $request->status ?? 'pending' }}</span></li>
                @empty
                    <li class="text-gray-500">Tidak ada request buku</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Category Requests</h2>
            <ul>
                @forelse($categoryRequests as $request)
                    <li class="mb-2">{{ $request->name ?? 'Nama kategori kosong' }} - <span class="text-sm text-gray-500">{{ $request->status ?? 'pending' }}</span></li>
                @empty
                    <li class="text-gray-500">Tidak ada request kategori</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
