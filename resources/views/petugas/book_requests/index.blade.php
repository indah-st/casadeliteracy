@extends('layouts.app-dashboardstaff')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <h1 class="text-2xl font-bold mb-6">Ajukan Request Buku</h1>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM CREATE --}}
    <div class="mb-8 bg-white p-6 rounded-xl shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Tambah Request Buku</h2>
        <form action="{{ route('petugas.book_requests.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">Judul Buku</label>
                <input type="text" name="judul" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Penulis</label>
                <input type="text" name="penulis" class="w-full border rounded px-3 py-2" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Submit Request
            </button>
        </form>
    </div>

    {{-- TABLE LIST REQUEST --}}
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Daftar Request Buku</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">Judul Buku</th>
                        <th class="py-2 px-4 border-b">Pengaju</th>
                        <th class="py-2 px-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookRequests as $request)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $request->judul }}</td>
                            <td class="py-2 px-4 border-b">{{ $request->user->name ?? 'Tidak ada' }}</td>
                            <td class="py-2 px-4 border-b capitalize">{{ $request->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-4 text-center">Belum ada request buku</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection