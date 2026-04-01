<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Approvals</title>

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

.tabs{
display:flex;
gap:10px;
margin-bottom:20px;
}

.tab{
padding:8px 16px;
background:white;
border-radius:8px;
border:1px solid #ddd;
cursor:pointer;
}

.tab.active{
background:#4f46e5;
color:white;
}

.card{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 5px 20px rgba(0,0,0,0.05);
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:12px;
border-bottom:1px solid #eee;
text-align:left;
}

.status{
padding:4px 10px;
border-radius:20px;
font-size:12px;
}

.pending{
background:#fff3cd;
color:#856404;
}

.approved{
background:#d4edda;
color:#155724;
}

.rejected{
background:#f8d7da;
color:#721c24;
}

.btn{
padding:6px 12px;
border:none;
border-radius:6px;
cursor:pointer;
font-size:12px;
}

.approve{
background:#16a34a;
color:white;
}

.reject{
background:#dc2626;
color:white;
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

    <!-- TAB -->
    <div class="tabs">
        <div class="tab active" onclick="showTab(event,'peminjaman')">Peminjaman</div>
        <div class="tab" onclick="showTab(event,'buku')">Request Buku</div>
        <div class="tab" onclick="showTab(event,'kategori')">Request Kategori</div>
        <div class="tab" onclick="showTab(event,'approvals')">Approvals</div>
    </div>

    <!-- ================= PEMINJAMAN ================= -->
    <div id="peminjaman" class="tab-content">
        <h1 class="text-2xl font-bold mb-6">Persetujuan Peminjaman</h1>

        @foreach($borrowings as $b)
        <div class="card mb-4">
            <h2 class="font-semibold">{{ $b->book->judul ?? '-' }}</h2>
            <p>{{ $b->user->name ?? '-' }}</p>
            <p>{{ $b->tanggal_pinjam }} → {{ $b->tanggal_kembali }}</p>

            <div class="mb-2">
                <span class="status {{ $b->status }}">
                    {{ $b->status }}
                </span>
            </div>

            @if($b->status == 'pending')
            <div class="flex gap-2">
                <form action="{{ route('admin.approvals.approve', $b->id) }}" method="POST">@csrf
                    <button class="btn approve">Approve</button>
                </form>

                <form action="{{ route('admin.approvals.reject', $b->id) }}" method="POST">@csrf
                    <button class="btn reject">Tolak</button>
                </form>
            </div>
            @endif

            @if($b->status == 'menunggu_pengembalian')
            <div class="flex gap-2 mt-2">
                <form action="{{ route('admin.peminjaman.approveReturn', $b->id) }}" method="POST">@csrf
                    <button class="btn approve">Approve Return</button>
                </form>

                <form action="{{ route('admin.peminjaman.rejectReturn', $b->id) }}" method="POST">@csrf
                    <button class="btn reject">Tolak Return</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- ================= BUKU ================= -->
    <div id="buku" class="tab-content" style="display:none;">
        <h1 class="text-2xl font-bold mb-6">Request Buku</h1>

        @foreach($bookRequests as $req)
        <div class="card mb-4">
            <h2 class="font-semibold">{{ $req->judul }}</h2>
            <p>{{ $req->penulis }}</p>

            <span class="status {{ $req->status }}">
                {{ $req->status }}
            </span>

            @if($req->status == 'pending')
            <div class="mt-3 flex gap-2">
                <form action="/admin/approve-book/{{ $req->id }}" method="POST">@csrf
                    <button class="btn approve">Approve</button>
                </form>

                <form action="/admin/reject-book/{{ $req->id }}" method="POST">@csrf
                    <button class="btn reject">Reject</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- ================= KATEGORI ================= -->
    <div id="kategori" class="tab-content" style="display:none;">
        <h1 class="text-2xl font-bold mb-6">Request Kategori</h1>

        @foreach($categoryRequests as $req)
        <div class="card mb-4">
            <h2 class="font-semibold">{{ $req->name }}</h2>

            <span class="status {{ $req->status }}">
                {{ $req->status }}
            </span>

            @if($req->status == 'pending')
            <div class="mt-3 flex gap-2">
                <form action="/admin/approve-category/{{ $req->id }}" method="POST">@csrf
                    <button class="btn approve">Approve</button>
                </form>

                <form action="/admin/reject-category/{{ $req->id }}" method="POST">@csrf
                    <button class="btn reject">Reject</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- ================= APPROVALS ================= -->
    <div id="approvals" class="tab-content" style="display:none;">
        <h1 class="text-2xl font-bold mb-6">Approvals</h1>

        @foreach($approvals as $approval)
        <div class="card mb-4">
            <h2 class="font-semibold">{{ ucfirst($approval->type) }} - {{ ucfirst($approval->action) }}</h2>
            <p>By: {{ $approval->user->name }}</p>
            <p>Data: {{ json_encode($approval->data) }}</p>

            <span class="status {{ $approval->status }}">
                {{ $approval->status }}
            </span>

            @if($approval->status == 'pending')
            <div class="mt-3 flex gap-2">
                <form action="{{ route('admin.approvals.approve', $approval->id) }}" method="POST">@csrf
                    <button class="btn approve">Approve</button>
                </form>

                <form action="{{ route('admin.approvals.reject', $approval->id) }}" method="POST">@csrf
                    <button class="btn reject">Reject</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>

</div>

</div>

<script>

function showTab(e, tab){
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.getElementById(tab).style.display = 'block';

    document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
    e.target.classList.add('active');
    
}

function toggleDropdown(){
    const drop = document.getElementById("dropdown");
    drop.style.display = drop.style.display === "block" ? "none" : "block";
}
</script>
</body>
</html>