<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Data Buku</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
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

<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-green-700 tracking-tight">
            📚 Data Buku
        </h1>
        <p class="text-gray-500 mt-1 text-sm md:text-base">
            Kelola semua data buku perpustakaan di sini.
        </p>
    </div>

    <a href="{{ route('admin.books.create') }}"
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

                            <a href="{{ route('admin.books.edit', $book->id) }}"
                               class="bg-white border border-yellow-400 text-yellow-500 px-4 py-2 rounded-xl hover:bg-yellow-400 hover:text-white transition-all duration-300 text-sm font-semibold shadow-sm">
                                ✏ Edit
                            </a>

                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
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

</div>

<script>
function toggleDropdown(){
    const drop = document.getElementById("dropdown");
    drop.style.display = drop.style.display === "block" ? "none" : "block";
}
</script>
</body>
</html>