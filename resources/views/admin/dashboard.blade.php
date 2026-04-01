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
    display: flex;
    flex-direction: column; /* stack ke bawah */
    gap: 25px;              /* jarak antar card */
    margin-bottom: 40px;
}

.cards a.card {
    width: 100%;            /* full lebar content container */
    max-width: 500px;       /* optional biar nggak terlalu lebar */
    padding: 20px 25px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    gap: 18px;
    border-left: 6px solid #03AC0E;
    background: white;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    text-decoration: none;
    color: inherit;
    transition: transform 0.2s, box-shadow 0.2s;
}

.cards a.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    cursor: pointer;
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
        <img src="{{ asset('images/Logo.jpeg') }}" width-2 alt="Logo">
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

        <div class="cards">
            <div class="cards">
    <!-- Card 1: Tambah Buku -->
    <a href="{{ route('admin.books.create') }}" class="card">
        <i class="fa fa-plus"></i>
        <div>
            <h3>Tambah Buku</h3>
            <p>Langsung masuk ke form input buku baru</p>
        </div>
    </a>

    <!-- Card 2: Approve Peminjaman -->
    <a href="{{ route('admin.approvals.index') }}" class="card">
        <i class="fa fa-check"></i>
        <div>
            <h3>Approve Peminjaman</h3>
            <p>Cek peminjaman yang menunggu persetujuan</p>
        </div>
    </a>

    <!-- Card 3: Kelola Petugas -->
    <a href="{{ route('admin.petugas.index') }}" class="card">
        <i class="fa fa-user-shield"></i>
        <div>
            <h3>Kelola Petugas</h3>
            <p>Tambah atau hapus akun petugas</p>
        </div>
    </a>

    <!-- Card 4: Cetak Laporan -->
    <a href="{{ route('admin.laporan.index') }}" class="card">
        <i class="fa fa-file-alt"></i>
        <div>
            <h3>Cetak Laporan</h3>
            <p>Cetak laporan harian atau bulanan</p>
        </div>
    </a>
</div>
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
