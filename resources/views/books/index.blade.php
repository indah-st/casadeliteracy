<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 to-white min-h-screen p-6">

<div class="max-w-7xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-green-100">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-green-600">📚 Data Buku</h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola semua buku yang tersedia
            </p>
        </div>

        <a href="{{ route('books.create') }}"
           class="bg-green-600 text-white px-5 py-2 rounded-xl 
                  hover:bg-green-700 transition shadow-md">
            + Tambah Buku
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-green-100 text-green-700">
                    <th class="p-3">No</th>
                    <th class="p-3">Cover</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Penulis</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Stok</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach ($books as $book)
                <tr class="hover:bg-green-50 transition">
                    <td class="p-3">{{ $loop->iteration }}</td>

                    <td class="p-3">
                        @if($book->cover)
                            <img src="{{ asset('covers/'.$book->cover) }}" 
                                 class="w-14 h-20 object-cover rounded-lg shadow">
                        @else
                            <div class="w-14 h-20 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-400">
                                No Cover
                            </div>
                        @endif
                    </td>

                    <td class="p-3 font-semibold text-gray-800">
                        {{ $book->judul }}
                    </td>

                    <td class="p-3 text-gray-600">
                        {{ $book->penulis }}
                    </td>

                    <!-- MANY TO MANY CATEGORY -->
                    <td class="p-3">
                        @foreach($book->categories as $category)
                            <span class="bg-green-100 text-green-700 
                                         px-2 py-1 rounded-full text-xs mr-1">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </td>

                    <!-- STOK WITH COLOR -->
                    <td class="p-3">
                        @if($book->stok > 5)
                            <span class="text-green-600 font-semibold">
                                {{ $book->stok }}
                            </span>
                        @elseif($book->stok > 0)
                            <span class="text-yellow-500 font-semibold">
                                {{ $book->stok }}
                            </span>
                        @else
                            <span class="text-red-500 font-semibold">
                                Habis
                            </span>
                        @endif
                    </td>

                    <td class="p-3 flex gap-2">
                        <a href="{{ route('books.edit', $book->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 
                                  text-white px-3 py-1 rounded-lg text-xs shadow">
                            Edit
                        </a>

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau hapus buku ini?')"
                                    class="bg-red-500 hover:bg-red-600 
                                           text-white px-3 py-1 rounded-lg text-xs shadow">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>