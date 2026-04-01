<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Kategori</title>

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
    overflow:hidden;
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

        
        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 2px #22c55e;
            border-color: #22c55e;
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

<div class="min-h-[75vh] flex flex-col items-center py-6 px-2 sm:px-0 w-full">

    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">Kategori Buku</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-4 w-full max-w-md bg-green-100 text-green-800 px-4 py-2 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah Kategori --}}
    <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-10 flex gap-4 w-full max-w-md">
        @csrf
        <input type="text" name="name" placeholder="Nama kategori baru"
               class="flex-1 border rounded-lg px-5 py-5 border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            Tambah
        </button>
    </form>

    {{-- Daftar Kategori --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full max-w-3xl">
        @foreach($categories as $category)
            <div class="bg-gradient-to-br from-green-100 to-white border border-green-300 
                        rounded-2xl shadow-sm p-10 hover:shadow-lg hover:-translate-y-1 
                        transition duration-300">
                <span style="color:#000 !important font-semibold text-lg text-green-700 mb-2">{{ $category->name }}</span>
                <div class="flex gap-2">
                    {{-- Edit --}}
                    <button onclick="openEdit({{ $category->id }}, '{{ $category->name }}')"
                        class="text-blue-500 hover:text-blue-700 font-semibold">
                        Edit
                    </button>
                    </a>
                    {{-- Delete --}}
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</div>

<!-- MODAL EDIT -->
<div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center">
    <div class="bg-green p-6 rounded-xl shadow-xl w-full max-w-md">
        <h2 class="text-lg font-bold mb-4">Edit Kategori</h2>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="text" id="editName" name="name"
                   class="w-full border rounded px-3 py-2 mb-4" required>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEdit()"
                        class="px-4 py-2 bg-gray-400 text-white rounded">
                    Batal
                </button>

                <button class="px-4 py-2 bg-green-600 text-white rounded">
                    Update
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

function openEdit(id, name) {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');

    document.getElementById('editName').value = name;

    document.getElementById('editForm').action = `/admin/categories/${id}`;
}

function closeEdit() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>

</body>
</html>
