<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Edit Buku</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    height: 100vh;
    margin: 0;
    background: #f4fdf7;
    overflow: hidden;
}

/* ================= SIDEBAR ================= */
.sidebar {
   width: 260px;
    background: #03AC0E;
    color: white;
    padding: 20px;
}

.sidebar .logo {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
}

.sidebar .logo img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    background: white;
    padding: 8px;
    border-radius: 100%;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    margin-bottom: 8px;
}

/* MENU ITEM */
.sidebar ul li a,
.sidebar ul li.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 12px;
    color: white;
    text-decoration: none;
    padding: 14px 18px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
}

.sidebar ul li a:hover,
.sidebar ul li.dropdown-toggle:hover {
    background: rgba(255,255,255,0.2);
}

.sidebar ul li a.active {
    background: rgba(255,255,255,0.3);
    font-weight: 600;
}

.sidebar i.right {
    margin-left: auto;
}

/* DROPDOWN */
.dropdown {
    display: none;
    margin-left: 10px;
}

.dropdown li a {
    font-size: 15px;
    background: rgba(255,255,255,0.15);
}

/* ================= MAIN ================= */
.main {
    flex: 1;
    display: flex;
    flex-direction: column;
    color: #000; 
}

/* TOPBAR */
.topbar {
    background: white;
    color: #03AC0E;
    text-align: center;
    padding: 20px;
    font-size: 28px;
    font-weight: bold;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

/* CONTENT */
.content {
    flex: 1;
    padding: 40px 30px;
    background: #f4fdf7;
    overflow-y:auto;
}

.ts-control {
    border-radius: 16px !important;
    border: 1px solid #bbf7d0 !important;
    padding: 12px !important;
}

.ts-control.focus {
    box-shadow: 0 0 0 2px #22c55e !important;
    border-color: #22c55e !important;
}

            
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('images/Logo.jpeg') }}" alt="Logo">
    </div>

   <ul>
        <li>
            <a href="/admin">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
                <a href="{{ route('admin.categories.index') }}">
                <i class="fa fa-tags"></i>
                <span>Kategori Buku</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.books.index') }}">
                <i class="fa fa-book"></i>
                <span>Data Buku</span>
            </a>
        </li>

        <li class="dropdown-toggle" onclick="toggleDropdown()">
            <i class="fa fa-database"></i>
            <span>Data</span>
            <i class="fa fa-caret-down right"></i>
        </li>

        <ul class="dropdown" id="dropdown">
            <li><a href="{{ route('admin.peminjaman.index') }}">Data Peminjaman</a></li>
            <li><a href="{{ route('admin.users.index') }}">Data User</a></li>
            <li><a href="{{ route('admin.petugas.index') }}">Data Petugas</a></li>
        </ul>

        <li>
            <a href="{{ route('admin.approvals.index') }}">
                <i class="fa fa-file"></i>
                <span>Persetujuan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.laporan.index') }}">
                <i class="fa fa-file"></i>
                <span>Laporan</span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>

<!-- MAIN -->
<div class="main">
    <div class="topbar">Casa De Literacy</div>

<div class="content">

<div class="max-w-5xl mx-auto mt-10">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-green-700">
            ✏️ Edit Buku
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Perbarui data buku dengan benar.
        </p>
    </div>

    <!-- Error -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-2xl mb-6">
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card -->
    <div class="bg-white p-10 rounded-3xl shadow-xl border border-green-100">

        <form action="{{ route('admin.books.update', $book->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">

                <!-- Judul -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Judul Buku
                    </label>
                    <input type="text" name="judul"
                        value="{{ old('judul', $book->judul) }}"
                        class="w-full border border-green-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Penulis
                    </label>
                    <input type="text" name="penulis"
                        value="{{ old('penulis', $book->penulis) }}"
                        class="w-full border border-green-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <!-- Penerbit -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Penerbit
                    </label>
                    <input type="text" name="penerbit"
                        value="{{ old('penerbit', $book->penerbit) }}"
                        class="w-full border border-green-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Tahun Terbit
                    </label>
                    <input type="number" name="tahun"
                        value="{{ old('tahun', $book->tahun) }}"
                        class="w-full border border-green-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Stok Buku
                    </label>
                    <input type="number" name="stok"
                        value="{{ old('stok', $book->stok) }}"
                        class="w-full border border-green-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <textarea name="sinopsis"
                    class="w-full border rounded-lg p-2"
                    placeholder="Sinopsis buku">{{ $book->sinopsis }}</textarea>

                <input type="number" name="jumlah_halaman"
                    class="w-full border rounded-lg p-2"
                    placeholder="Jumlah Halaman"
                    value="{{ $book->jumlah_halaman }}">

                <!-- Kategori -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Kategori Buku
                    </label>

                    <select id="categories"
                            name="categories[]"
                            multiple
                            placeholder="Pilih kategori..."
                            class="w-full">

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $book->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    <p class="text-xs text-gray-400 mt-2">
                        Bisa pilih lebih dari satu kategori
                    </p>
                </div>
                <!-- Cover Lama -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-3 text-gray-700">
                        Cover Saat Ini
                    </label>

                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}"
                             class="w-32 h-44 object-cover rounded-xl shadow mb-4">
                    @else
                        <p class="text-gray-400 text-sm">Belum ada cover</p>
                    @endif
                </div>

                <!-- Upload Cover Baru -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Ganti Cover (Opsional)
                    </label>
                    <input type="file" name="cover"
                        class="w-full border border-green-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>

            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4 pt-6">
                <a href="{{ route('admin.books.index') }}"
                   class="px-6 py-2 rounded-xl border border-gray-300 hover:bg-gray-100 transition">
                    Batal
                </a>

                <button type="submit"
                    class="bg-green-600 text-white px-8 py-2 rounded-xl shadow hover:bg-green-700 transition font-semibold">
                    Update Buku
                </button>
            </div>

        </form>

    </div>

</div>
<script>
function toggleDropdown(){
    const drop = document.getElementById("dropdown");
    drop.style.display = drop.style.display === "block" ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", function() {
    new TomSelect("#categories", {
        plugins: ['remove_button'],
        placeholder: "Pilih kategori...",
        create: false,
        maxItems: null,
    });
});

</script>
</body>
</html>