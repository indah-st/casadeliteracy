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
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
    margin-bottom: 40px;
}

.cards a.card {
    width: 100%;
    padding: 24px;
    border-radius: 22px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    border: 1px solid #e8f3eb;
    border-left: 6px solid #03AC0E;
    background: white;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    text-decoration: none;
    color: inherit;
    transition: all 0.25s ease;
}

.cards a.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 30px rgba(0,0,0,0.08);
}



.card i {
    width: 58px;
    height: 58px;
    border-radius: 16px;
    background: rgba(3, 172, 14, 0.08);
    color: #03AC0E;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.card h3 {
    font-size: 18px;
    color: #1f2937;
    margin-bottom: 6px;
}

.card p {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
}

/* REVIEW SECTION */
.review-section-title {
    font-size: 26px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 24px;
}

.review-card {
    background: white;
    border-radius: 22px;
    border: 1px solid #edf2ee;
    padding: 24px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    transition: all 0.25s ease;
}

.review-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

/* MODAL */
#reviewModal {
    backdrop-filter: blur(4px);
}

#reviewModal .bg-white {
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.18);
}

#reviewComment {
    line-height: 1.7;
}

/* SCROLLBAR */
.content::-webkit-scrollbar {
    width: 10px;
}

.content::-webkit-scrollbar-track {
    background: transparent;
}

.content::-webkit-scrollbar-thumb {
    background: #c8e6ce;
    border-radius: 20px;
}

.content::-webkit-scrollbar-thumb:hover {
    background: #9fd8aa;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    body {
        flex-direction: column;
        overflow-y: auto;
    }

    .sidebar {
        width: 100%;
        height: auto;
    }

    .content {
        padding: 24px;
    }

    .cards {
        grid-template-columns: 1fr;
    }
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

<div class="content space-y-8">

   <!-- HERO SECTION -->
<div class="bg-gradient-to-r from-green-800 via-emerald-700 to-green-600 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-52 h-52 bg-green-300/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        <div>
            <p class="text-green-100 text-sm mb-2 uppercase tracking-widest">Dashboard Admin</p>
            <h1 class="text-4xl font-bold mb-3">Kelola Perpustakaan Dengan Mudah</h1>
            <p class="text-green-50 max-w-2xl">
                Pantau aktivitas perpustakaan, kelola buku, approve peminjaman, dan lihat review terbaru pengguna dalam satu dashboard.
            </p>
        </div>

       
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-4 min-w-[140px] border border-white/10">
                <p class="text-sm text-green-100">Hari Ini</p>
                <h3 class="text-2xl font-bold mt-1">{{ now()->format('d M') }}</h3>
            </div>
        
    </div>
</div>

    <!-- QUICK ACTIONS -->
    <div>
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Quick Actions</h2>
                <p class="text-gray-500 text-sm">Akses cepat ke fitur penting dashboard admin</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
            <a href="{{ route('admin.books.create') }}" class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition">
                    <i class="fa fa-plus"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Tambah Buku</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Masukkan buku baru ke sistem perpustakaan dengan cepat.</p>
            </a>

            <a href="{{ route('admin.approvals.index') }}" class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition">
                    <i class="fa fa-check"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Approve Peminjaman</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Periksa dan setujui peminjaman yang masih menunggu.</p>
            </a>

            <a href="{{ route('admin.petugas.index') }}" class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition">
                    <i class="fa fa-user-shield"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Kelola Petugas</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Tambah, edit, atau hapus akun petugas perpustakaan.</p>
            </a>

            <a href="{{ route('admin.laporan.index') }}" class="group bg-white rounded-3xl p-6 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition">
                    <i class="fa fa-file-alt"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Cetak Laporan</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Cetak laporan harian, mingguan, atau bulanan.</p>
            </a>
        </div>
    </div>

    <!-- BUKU TERBARU SECTION -->
    <div class="mt-10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">📚 Buku Terbaru</h2>
                <p class="text-sm text-gray-500 mt-1">Daftar buku yang baru ditambahkan ke sistem</p>
            </div>
        </div>

        @if($latestBooks && $latestBooks->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($latestBooks as $book)
                    <a href="{{ route('books.show', $book->id) }}" class="group">
                        <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}" class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-xs">
                                    No Cover
                                </div>
                            @endif
                        </div>
                        <h3 class="text-sm font-semibold text-gray-800 mt-2 line-clamp-2">{{ $book->judul }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $book->penulis ?? 'Penulis' }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl border border-dashed border-gray-300 p-10 text-center shadow-sm">
                <i class="fa fa-books text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada buku ditambahkan</p>
            </div>
        @endif
    </div>

    <!-- REVIEW SECTION -->
    <div class="mt-10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">📋 Review Terbaru Pengguna</h2>
                <p class="text-sm text-gray-500 mt-1">Lihat review terbaru dari pengguna perpustakaan</p>
            </div>
        </div>

        @isset($latestReviews)
        @if($latestReviews->isEmpty())
            <div class="bg-white rounded-3xl border border-dashed border-gray-300 p-10 text-center shadow-sm">
                <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-3xl text-gray-400 mb-4">
                    <i class="fa fa-comments"></i>
                </div>
                <p class="text-lg font-semibold text-gray-600">Belum ada review dari pengguna</p>
                <p class="text-sm text-gray-400 mt-1">Review akan muncul di sini setelah pengguna memberikan penilaian buku.</p>
            </div>
        @else
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                @foreach($latestReviews as $review)
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex justify-between items-start gap-4">
                            <div class="flex gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-400 to-emerald-600 text-white flex items-center justify-center text-lg font-bold shadow-lg">
                                    {{ strtoupper(substr($review->user->name ?? 'P', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="text-lg font-bold text-gray-800 leading-snug">
                                        {{ $review->user->name ?? 'Pengguna' }}
                                    </p>
                                    <p class="text-sm text-gray-500 mb-3">
                                        Mereview buku <span class="font-semibold text-green-600">{{ $review->book->judul ?? 'Buku' }}</span>
                                    </p>

                                    <div class="flex items-center gap-2 text-sm text-yellow-500 mb-2">
                                        <i class="fa fa-star"></i>
                                        <span class="font-semibold text-gray-700">{{ $review->rating }}/5</span>
                                    </div>

                                    <p class="text-sm text-gray-400">
                                        {{ $review->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <button class="view-review-btn px-4 py-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold text-sm transition"
                                data-review-id="{{ $review->id }}"
                                data-user-name="{{ $review->user->name }}"
                                data-book-title="{{ $review->book->judul }}"
                                data-rating="{{ $review->rating }}"
                                data-comment="{{ $review->komentar }}"
                                data-date="{{ $review->created_at->format('d M Y') }}"
                                data-route="{{ route('admin.review.destroy', $review->id) }}">
                                Lihat Review
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @endisset
    </div>

    <!-- REVIEW MODAL -->
    <div id="reviewModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full p-8 relative border border-slate-100">
            <button type="button" class="absolute top-5 right-6 text-slate-400 hover:text-slate-700 text-3xl close-modal-btn">&times;</button>

            <div class="mb-8">
                <p class="uppercase tracking-[0.2em] text-xs font-semibold text-green-600 mb-2">Review Detail</p>
                <h3 class="text-2xl font-bold text-slate-800">Detail Review Pengguna</h3>
            </div>

            <div class="space-y-4 mb-8">
                <div class="bg-slate-50 rounded-2xl border border-slate-100 p-4">
                    <p class="text-sm text-slate-500 mb-1">Judul Buku</p>
                    <p class="font-semibold text-slate-800" id="reviewBookTitle">-</p>
                </div>
                <div class="bg-slate-50 rounded-2xl border border-slate-100 p-4">
                    <p class="text-sm text-slate-500 mb-1">Pengguna</p>
                    <p class="font-semibold text-slate-800" id="reviewUserName">-</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-2xl border border-slate-100 p-4">
                        <p class="text-sm text-slate-500 mb-1">Rating</p>
                        <p class="font-semibold text-slate-800" id="reviewRating">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl border border-slate-100 p-4">
                        <p class="text-sm text-slate-500 mb-1">Tanggal</p>
                        <p class="font-semibold text-slate-800" id="reviewDate">-</p>
                    </div>
                </div>
                <div class="bg-slate-50 rounded-2xl border border-slate-100 p-4">
                    <p class="text-sm text-slate-500 mb-2">Komentar</p>
                    <p class="text-slate-700 leading-relaxed" id="reviewComment">-</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" class="close-modal-btn flex-1 bg-slate-200 hover:bg-slate-300 text-slate-700 py-3 rounded-2xl font-semibold transition">Tutup</button>

                <form id="deleteReviewForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-2xl font-semibold transition">Hapus Review</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

function toggleDropdown(){
    const drop = document.getElementById("dropdown");
    drop.style.display = drop.style.display === "block" ? "none" : "block";
}

document.addEventListener('DOMContentLoaded', function() {
    const viewBtns = document.querySelectorAll('.view-review-btn');
    const modal = document.getElementById('reviewModal');
    const closeModalBtns = document.querySelectorAll('.close-modal-btn');
    const deleteForm = document.getElementById('deleteReviewForm');

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('reviewUserName').textContent = this.dataset.userName;
            document.getElementById('reviewBookTitle').textContent = this.dataset.bookTitle;
            document.getElementById('reviewRating').textContent = this.dataset.rating + '/5';
            document.getElementById('reviewComment').textContent = this.dataset.comment;
            document.getElementById('reviewDate').textContent = this.dataset.date;
            
            deleteForm.action = this.dataset.route;
            modal.classList.remove('hidden');
        });
    });

    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
</script>
