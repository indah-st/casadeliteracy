<!-- resources/views/layouts/app-dashboardstaff.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Petugas - Dashboard</title>

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

.sidebar ul { list-style: none; }

.sidebar ul li { margin-bottom: 8px; }

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
.sidebar ul li.dropdown-toggle:hover { background: rgba(255,255,255,0.2); }

.sidebar ul li a.active { background: rgba(255,255,255,0.3); font-weight: 600; }

.sidebar i.right { margin-left: auto; }

/* DROPDOWN */
.dropdown { display: none; margin-left: 10px; }
.dropdown li a { font-size: 15px; background: rgba(255,255,255,0.15); }

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
    width: 100%;
    max-width: 500px;
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

.card i { font-size: 36px; color: #03AC0E; }
.card h3 { font-size: 26px; color: #222; }
.card p { font-size: 14px; color: #777; }
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
            <a href="{{ route('petugas.dashboard') }}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('petugas.categories.index') }}">
                <i class="fa fa-tags"></i>
                <span>Kategori Buku</span>
            </a>
        </li>

        <li>
            <a href="{{ route('petugas.books.index') }}">
                <i class="fa fa-book"></i>
                <span>Data Buku</span>
            </a>
        </li>

        <!-- REQUEST DROPDOWN -->
        <li class="dropdown-toggle" onclick="toggleDropdown('requestDropdown')">
            <i class="fa fa-paper-plane"></i>
            <span>Ajukan Request</span>
            <i class="fa fa-caret-down right"></i>
        </li>
        <ul class="dropdown" id="requestDropdown">
            <li><a href="{{ route('petugas.book_requests.index') }}">Request Buku</a></li>
            <li><a href="{{ route('petugas.category_requests.index') }}">Request Kategori</a></li>
        </ul>

        <!-- DATA DROPDOWN -->
        <li class="dropdown-toggle" onclick="toggleDropdown('dataDropdown')">
            <i class="fa fa-database"></i>
            <span>Data</span>
            <i class="fa fa-caret-down right"></i>
        </li>
        <ul class="dropdown" id="dataDropdown">
            <li><a href="{{ route('petugas.peminjaman.index') }}">Data Peminjaman</a></li>
            <li><a href="{{ route('petugas.users.index') }}">Data User</a></li>
        </ul>

        <li>
            <a href="{{ route('petugas.approvals.index') }}">
                <i class="fa fa-file"></i>
                <span>Persetujuan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('petugas.laporan.index') }}">
                <i class="fa fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li>

        <li>
            <form action="{{ route('petugas.logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>

<!-- MAIN -->
<div class="main">
    <div class="topbar">Casa De Literacy</div>

{{-- CONTENT --}}
    <div class="w-full px-6 py-6">
        @yield('content')
        
    <script>
    
function toggleDropdown(id){
    const drop = document.getElementById(id);
    drop.style.display = drop.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>