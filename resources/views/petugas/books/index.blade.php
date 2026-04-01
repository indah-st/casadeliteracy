@extends('layouts.app-dashboardstaff')

@section('content')

<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-green-700 tracking-tight">
            📚 Data Buku
        </h1>
        <p class="text-gray-500 mt-1 text-sm md:text-base">
            Kelola semua data buku perpustakaan di sini.
        </p>
    </div>

    <a href="{{ route('petugas.books.create') }}"
       class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg hover:bg-green-700 hover:shadow-xl transition-all duration-300 text-sm md:text-base font-semibold">
        ➕ Tambah Buku
    </a>
</div>


@if (session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-3 rounded-xl mb-6 shadow">
        {{ session('success') }}
    </div>
@endif


<div class="bg-white rounded-3xl shadow-xl border border-green-100 overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full text-base text-left">

            <thead class="bg-green-600 text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Cover</th>
                    <th class="px-6 py-4">Judul</th>
                    <th class="px-6 py-4">Penulis</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Halaman</th>
                    <th class="px-6 py-4">Sinopsis</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-green-100">

                @foreach ($books as $book)
                <tr class="hover:bg-green-50 transition">

                    <td class="px-6 py-5 font-semibold text-gray-700">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-5">
                        @if($book->cover)
                            <img src="{{ asset('storage/'.$book->cover) }}"
                                class="w-16 h-24 object-cover rounded-xl shadow">
                        @else
                            <div class="w-16 h-24 bg-green-100 flex items-center justify-center rounded-xl text-green-600 text-xs">
                                No Cover
                            </div>
                        @endif
                    </td>

                    <td class="px-6 py-5 font-bold text-gray-800 text-lg">
                        {{ $book->judul }}
                    </td>

                    <td class="px-6 py-5 text-gray-600">
                        {{ $book->penulis }}
                    </td>

                    <td class="px-6 py-5">
                        <div class="flex flex-wrap gap-2">
                            @foreach($book->categories as $category)
                                <span class="bg-green-100 text-green-700 px-3 py-1 text-xs font-semibold rounded-full shadow-sm">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </td>

                    <td class="px-6 py-5 text-gray-700">
                        {{ $book->jumlah_halaman ?? '-' }}
                    </td>

                    <td class="px-6 py-5 text-gray-600 max-w-[250px] truncate">
                        {{ $book->sinopsis ?? '-' }}
                    </td>

                    <td>
                        @if($book->stok > 5)
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
                                {{ $book->stok }} Tersedia
                            </span>
                        @elseif($book->stok > 0)
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                Menipis ({{ $book->stok }})
                            </span>
                        @else
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-700">
                                Habis
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-5">
                        <div class="flex flex-wrap gap-2 justify-center">

                            <a href="{{ route('petugas.books.edit', $book->id) }}"
                               class="bg-white border border-yellow-400 text-yellow-500 px-4 py-2 rounded-xl hover:bg-yellow-400 hover:text-white transition-all duration-300 text-sm font-semibold shadow-sm">
                                ✏ Edit
                            </a>

                            <form action="{{ route('petugas.books.destroy', $book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus buku ini?')"
                                        class="bg-white border border-red-500 text-red-500 px-4 py-2 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-300 text-sm font-semibold shadow-sm">
                                    🗑 Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>
    </div>
@endsection