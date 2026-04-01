<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Dashboard</title>

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
    overflow-y: auto;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    margin-bottom: 40px;
}

.card {
    background: white;
    padding: 25px 20px;
    border-radius: 18px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 18px;
    border-left: 6px solid #03AC0E;
}

.card i {
    font-size: 36px;
    color: #03AC0E;
}

.card h3 {
    font-size: 26px;
    color: #222;
}

.card p {
    font-size: 14px;
    color: #777;
}

/* PROGRESS & ACTIVITY */
.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.progress-box,
.activity-box {
    background: white;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.progress-box h2,
.activity-box h2 {
    color: #03AC0E;
    margin-bottom: 20px;
}

.progress-bar {
    width: 100%;
    height: 12px;
    background: #e5f6ea;
    border-radius: 10px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: #03AC0E;
}

.activity {
    display: flex;
    gap: 12px;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    padding-bottom: 12px;
}

.activity:last-child {
    border-bottom: none;
}

.activity i {
    color: #03AC0E;
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
        <div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Data Peminjaman</h1>

    @if($borrowings->isEmpty())
        <p class="text-gray-500">Belum ada data</p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($borrowings as $b)
                <div class="bg-white p-5 rounded-2xl shadow">

                    <h2 class="font-semibold text-lg">
                        {{ $b->book->judul }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $b->user->name }}
                    </p>

                    <p class="text-sm text-gray-400 mb-2">
                        {{ $b->tanggal_pinjam }} → {{ $b->tanggal_kembali }}
                    </p>

                    

                    {{-- STATUS --}}
                 @if($b->status == 'pending')
    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
        Pending
    </span>

@elseif($b->status == 'dipinjam')
    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
        Dipinjam
    </span>

@elseif($b->status == 'menunggu_pengembalian')
    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-medium">
        Menunggu
    </span>

@elseif($b->status == 'selesai')
    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
        Selesai
    </span>

@elseif($b->status == 'dikembalikan')
    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
        Dikembalikan
    </span>

@elseif($b->status == 'ditolak')
    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
        Ditolak
    </span>
@endif


                </div>
            @endforeach

        </div>
    @endif
</div>

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
