<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Tambah Buku</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"> </script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js">
</script>
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
    border: 1px solid #86efac !important;
    padding: 10px !important;
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
    <div class="bg-white rounded-3xl shadow-xl border border-green-100 p-12">

        <form action="{{ route('admin.books.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-10">
            @csrf

            <div class="grid md:grid-cols-2 gap-8">

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
                            class="w-full">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
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
            <div class="flex justify-end gap-4 pt-8">
                <a href="{{ route('admin.books.index') }}"
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
function toggleDropdown(){
    const drop = document.getElementById("dropdown");
    drop.style.display = drop.style.display === "block" ? "none" : "block";
}

  new TomSelect("#categories", {
        plugins: ['remove_button'],
        placeholder: "Pilih kategori",
        persist: false,
        create: false,
    });

</script>
</body>
</html>