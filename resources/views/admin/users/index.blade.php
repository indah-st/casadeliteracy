<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Data User</title>

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
<div class="p-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-green-600 flex items-center gap-2">
            <i class="fa fa-users"></i> Data User
        </h2>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-green-600 text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Alamat</th>
                    <th class="p-4 text-left">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($users as $user)
                <tr class="border-b hover:bg-green-50 transition">
                    <td class="p-4">{{ $loop->iteration }}</td>
                    <td class="p-4 font-medium">{{ $user->name }}</td>
                    <td class="p-4">{{ $user->email }}</td>
                    <td class="p-4">{{ $user->address ?? '-' }}</td>
                    <td class="p-4">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
</tbody>
            </table>
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