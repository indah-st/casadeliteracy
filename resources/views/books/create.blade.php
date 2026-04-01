<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-xl font-bold mb-4">➕ Tambah Buku</h1>
z
    <form action="{{ route('books.store') }}" method="POST" 
          enctype="multipart/form-data" 
          class="space-y-3">
        @csrf

        <input type="text" name="judul" placeholder="Judul"
            class="w-full border p-2 rounded" required>

        <input type="text" name="penulis" placeholder="Penulis"
            class="w-full border p-2 rounded" required>

        <input type="text" name="penerbit" placeholder="Penerbit"
            class="w-full border p-2 rounded" required>

        <input type="number" name="tahun" placeholder="Tahun"
            class="w-full border p-2 rounded" required>

        <div>
            <div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" required class="form-control">
        <option value="">-- Pilih Kategori --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
</div>



        <input type="number" name="stok" placeholder="Stok"
            class="w-full border p-2 rounded" required>

        <!-- Input Cover Buku -->
        <div>
            <label class="block text-sm font-medium mb-1">Cover Buku</label>
            <input type="file" name="cover"
                class="w-full border p-2 rounded"
                accept="image/*">
        </div>

        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
            Simpan
        </button>
    </form>
</div>

</body>
</html>
