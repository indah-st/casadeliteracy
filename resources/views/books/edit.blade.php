<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-xl font-bold mb-4">✏️ Edit Buku</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-3">
        @csrf
        @method('PUT')

        <input type="text" name="judul" value="{{ $book->judul }}"
            class="w-full border p-2 rounded" required>
        <input type="text" name="penulis" value="{{ $book->penulis }}"
            class="w-full border p-2 rounded" required>
        <input type="text" name="penerbit" value="{{ $book->penerbit }}"
            class="w-full border p-2 rounded" required>
        <input type="number" name="tahun" value="{{ $book->tahun }}"
            class="w-full border p-2 rounded" required>
        <input type="text" name="genre" value="{{ $book->genre }}"
            class="w-full border p-2 rounded" required>
        <input type="number" name="stok" value="{{ $book->stok }}"
            class="w-full border p-2 rounded" required>

        <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Update
        </button>
    </form>
</div>

</body>
</html>
