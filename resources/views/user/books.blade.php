<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<h1 class="text-2xl font-bold mb-4">📚 Daftar Buku</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
@foreach($books as $book)
    <div class="bg-white p-4 rounded shadow">
        @if($book->cover)
            <img src="{{ asset('covers/'.$book->cover) }}" class="w-full h-48 object-cover mb-2 rounded">
        @endif

        <h2 class="font-bold">{{ $book->judul }}</h2>
        <p class="text-sm text-gray-600">{{ $book->penulis }}</p>
        <p class="text-sm">Stok: {{ $book->stok }}</p>

        @if($book->stok > 0)
            <form action="{{ route('borrow.store') }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button class="bg-green-600 text-white px-3 py-1 rounded w-full">
                    Pinjam
                </button>
            </form>
        @else
            <p class="text-red-500 mt-2 font-semibold">Stok habis</p>
        @endif
    </div>
@endforeach
</div>

</body>
</html>
