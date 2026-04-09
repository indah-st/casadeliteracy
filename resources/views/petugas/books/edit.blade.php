@extends('layouts.app-dashboardstaff')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Page Header -->
    <div class="mb-10 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-green-700 tracking-tight">
                Edit Buku
            </h1>
            <p class="text-gray-500 mt-2">
                Ajukan perubahan data buku untuk ditinjau oleh admin.
            </p>
        </div>

        <div class="bg-green-100 text-green-700 px-5 py-3 rounded-2xl shadow-sm">
            <i class="fa fa-book mr-2"></i> Form Edit Buku
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-5 rounded-2xl mb-8 shadow">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form -->
    <div class="bg-white rounded-3xl shadow-xl border border-green-100 p-12">

        <form action="{{ route('petugas.books.update', $book->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-10">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-8">

                <!-- Judul -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Judul Buku
                    </label>
                    <input type="text" name="judul"
                        value="{{ old('judul', $book->judul) }}"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 text-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Masukkan judul buku" required>
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Penulis
                    </label>
                    <input type="text" name="penulis"
                        value="{{ old('penulis', $book->penulis) }}"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Nama penulis" required>
                </div>

                <!-- Penerbit -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Penerbit
                    </label>
                    <input type="text" name="penerbit"
                        value="{{ old('penerbit', $book->penerbit) }}"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Nama penerbit" required>
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Tahun Terbit
                    </label>
                    <input type="number" name="tahun"
                        value="{{ old('tahun', $book->tahun) }}"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="2025" required>
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Stok Buku
                    </label>
                    <input type="number" name="stok"
                        value="{{ old('stok', $book->stok) }}"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Jumlah stok" required>
                </div>

                <!-- Sinopsis -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Sinopsis
                    </label>
                    <textarea name="sinopsis" rows="4"
                        class="w-full border rounded-lg p-3"
                        placeholder="Sinopsis buku" >{{ old('sinopsis', $book->sinopsis) }}</textarea>
                </div>

                <!-- Halaman -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Jumlah Halaman
                    </label>
                    <input type="number" name="jumlah_halaman"
                        value="{{ old('jumlah_halaman', $book->jumlah_halaman) }}"
                        class="w-full border rounded-lg p-3"
                        placeholder="Jumlah Halaman" >
                </div>

                <!-- Kategori -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Kategori Buku
                    </label>

                    <select id="categories"
                            name="categories[]"
                            multiple
                            class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <p class="text-xs text-gray-400 mt-3">
                        Bisa pilih lebih dari satu kategori
                    </p>
                </div>

                <!-- Cover -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Upload Cover Buku (opsional)
                    </label>

                    <div class="border-2 border-dashed border-green-200 rounded-2xl p-6 text-center hover:border-green-400 transition">
                        <input type="file" name="cover" class="w-full" accept="image/*">
                        <p class="text-sm text-gray-400 mt-2">
                            Biarkan kosong jika tidak ingin mengubah cover.
                        </p>
                    </div>
                </div>

            </div>

            <!-- Button -->
            <div class="flex justify-end gap-4 pt-8">
                <a href="{{ route('petugas.books.index') }}"
                   class="px-7 py-3 rounded-xl border border-gray-300 hover:bg-gray-100 transition font-medium">
                    Batal
                </a>

                <button type="submit"
                    class="bg-green-600 text-white px-10 py-3 rounded-xl shadow-lg hover:bg-green-700 hover:shadow-xl transition font-semibold text-lg">
                    Kirim Request Edit
                </button>
            </div>

        </form>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new TomSelect("#categories", {
        plugins: ['remove_button'],
        placeholder: "Pilih kategori",
        persist: false,
        create: false,
    });
});
</script>
@endsection