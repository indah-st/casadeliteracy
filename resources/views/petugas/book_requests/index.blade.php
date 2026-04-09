@extends('layouts.app-dashboardstaff')

@section('content')

<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-green-700 tracking-tight">
            📖 Request Buku
        </h1>
        <p class="text-gray-500 mt-1 text-sm md:text-base">
            Ajukan dan kelola permintaan buku baru untuk perpustakaan.
        </p>
    </div>
</div>


@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-3 rounded-xl mb-6 shadow">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-700 px-5 py-3 rounded-xl mb-6 shadow">
        <ul class="list-disc pl-5 space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- TABLE LIST REQUEST --}}
<div class="bg-white rounded-3xl shadow-xl border border-green-100 overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full text-base text-left">

            <thead class="bg-green-600 text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Cover</th>
                    <th class="px-6 py-4">Judul Buku</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Penulis</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4 text-center">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-green-100">
                @forelse($bookRequests as $request)
                    <tr class="hover:bg-green-50 transition">
                        <td class="px-6 py-5 font-semibold text-gray-700">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-5">
                            @if($request->cover)
                                <img src="{{ asset('storage/' . $request->cover) }}" 
                                     alt="Cover {{ $request->judul }}" 
                                     class="w-16 h-20 object-cover rounded-lg shadow-sm border border-gray-200">
                            @else
                                <div class="w-16 h-20 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                    No Cover
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-5 font-bold text-gray-800">
                            {{ $request->judul }}
                        </td>
                        <td class="px-6 py-5 text-gray-600">
                            {{ $request->categories->pluck('name')->join(', ') ?: ($request->category_id ? $request->category->name : '-') }}
                        </td>
                        <td class="px-6 py-5 text-gray-600">
                            {{ $request->penulis ?? '-' }}
                        </td>
                        <td class="px-6 py-5 text-gray-600 text-sm">
                            {{ $request->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($request->status === 'pending')
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    ⏳ Pending
                                </span>
                            @elseif($request->status === 'approved')
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
                                    ✓ Disetujui
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-700">
                                    ✗ Ditolak
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 px-6 text-center text-gray-500">
                            <div class="text-4xl mb-3">📭</div>
                            Belum ada request buku
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection