@extends('layouts.app-dashboardstaff')

@section('content')


<div class="max-w-6xl mx-auto">

    <!-- Page Header -->
    <div class="mb-10 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-green-700 tracking-tight">
                Tambah Buku Baru
            </h1>
            <p class="text-gray-500 mt-2">
                Lengkapi detail buku untuk ditambahkan ke sistem perpustakaan.
            </p>
        </div>

        <div class="bg-green-100 text-green-700 px-5 py-3 rounded-2xl shadow-sm">
            <i class="fa fa-book mr-2"></i> Form Input Buku
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
    <div class="bg-white rounded-3xl shadow-xl border border-green-100 p-8 max-h-[80vh] overflow-y-auto">

        <form action="{{ route('petugas.books.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-8">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">

                <!-- Judul -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Judul Buku
                    </label>
                    <input type="text" name="judul"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 text-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Masukkan judul buku">
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Penulis
                    </label>
                    <input type="text" name="penulis"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Nama penulis">
                </div>

                <!-- Penerbit -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Penerbit
                    </label>
                    <input type="text" name="penerbit"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Nama penerbit">
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Tahun Terbit
                    </label>
                    <input type="number" name="tahun"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="2025">
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Stok Buku
                    </label>
                    <input type="number" name="stok"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Jumlah stok">
                </div>

                <!-- Sinopsis -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Sinopsis Buku
                    </label>
                    <textarea name="sinopsis" placeholder="Sinopsis buku"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition h-24"
                        rows="4"></textarea>
                </div>

                <!-- Jumlah Halaman -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Jumlah Halaman
                    </label>
                    <input type="number" name="jumlah_halaman"
                        placeholder="Jumlah Halaman"
                        class="w-full border-2 border-green-100 rounded-2xl px-5 py-4 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition">
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
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <p class="text-xs text-gray-400 mt-3">
                        Bisa pilih lebih dari satu kategori
                    </p>
                </div>

                <!-- Cover -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-3">
                        Upload Cover Buku
                    </label>

                    <div class="border-2 border-dashed border-green-200 rounded-2xl p-8 text-center hover:border-green-400 transition">
                        <input type="file" name="cover" class="w-full">
                        <p class="text-sm text-gray-400 mt-2">
                            Format JPG / PNG
                        </p>
                    </div>
                </div>

            </div>

            <!-- Button -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('petugas.books.index') }}"
                   class="px-7 py-3 rounded-xl border border-gray-300 hover:bg-gray-100 transition font-medium">
                    Batal
                </a>

                <button type="submit"
                    class="bg-green-600 text-white px-10 py-3 rounded-xl shadow-lg hover:bg-green-700 hover:shadow-xl transition font-semibold text-lg">
                    Simpan Buku
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