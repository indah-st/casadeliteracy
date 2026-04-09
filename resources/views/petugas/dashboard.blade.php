
@extends('layouts.app-dashboardstaff')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-[32px] p-8 md:p-10 shadow-xl mb-8 text-white relative overflow-hidden">
        <div class="absolute right-0 top-0 w-40 h-40 bg-white/10 rounded-full -translate-y-10 translate-x-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full translate-y-10 -translate-x-10"></div>

        <div class="relative z-10">
            <p class="uppercase tracking-[0.25em] text-sm text-green-100 mb-3">Dashboard Petugas</p>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">
                Selamat datang, {{ Auth::guard('petugas')->user()->nama ?? 'Petugas' }}
            </h1>
            <p class="text-green-100 text-sm md:text-base max-w-2xl">
                Pantau data buku, pengguna, peminjaman aktif, serta review terbaru dalam satu dashboard.
            </p>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-[28px] p-6 shadow-sm border border-slate-100 hover:shadow-xl transition duration-300">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-slate-500 text-sm font-medium">Total Buku</p>
                    <h2 class="text-4xl font-bold text-slate-800 mt-2">{{ $totalBooks }}</h2>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">
                    <i class="fa fa-book text-blue-600 text-2xl"></i>
                </div>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="w-3/4 h-full bg-blue-500 rounded-full"></div>
            </div>
        </div>

        <div class="bg-white rounded-[28px] p-6 shadow-sm border border-slate-100 hover:shadow-xl transition duration-300">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-slate-500 text-sm font-medium">Total User</p>
                    <h2 class="text-4xl font-bold text-slate-800 mt-2">{{ $totalUsers }}</h2>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">
                    <i class="fa fa-users text-green-600 text-2xl"></i>
                </div>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="w-2/3 h-full bg-green-500 rounded-full"></div>
            </div>
        </div>

        <div class="bg-white rounded-[28px] p-6 shadow-sm border border-slate-100 hover:shadow-xl transition duration-300 sm:col-span-2 xl:col-span-1">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-slate-500 text-sm font-medium">Peminjaman Aktif</p>
                    <h2 class="text-4xl font-bold text-slate-800 mt-2">{{ $activeBorrowings }}</h2>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">
                    <i class="fa fa-book-open text-red-600 text-2xl"></i>
                </div>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="w-1/2 h-full bg-red-500 rounded-full"></div>
            </div>
        </div>
    </div>

    <!-- Buku Terbaru Section -->
    <div class="mb-10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">📚 Buku Terbaru</h2>
                <p class="text-slate-500 text-sm mt-1">Daftar buku yang baru ditambahkan</p>
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
                        <h3 class="text-sm font-semibold text-slate-800 mt-2 line-clamp-2">{{ $book->judul }}</h3>
                        <p class="text-xs text-slate-500 mt-1">{{ $book->penulis ?? 'Penulis' }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-[28px] border border-dashed border-slate-300 p-10 text-center">
                <i class="fa fa-books text-4xl text-slate-300 mb-4"></i>
                <p class="text-slate-500">Belum ada buku ditambahkan</p>
            </div>
        @endif
    </div>

    <!-- Request Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-10">

        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Book Requests</h2>
                    <p class="text-sm text-slate-500 mt-1">Daftar permintaan buku terbaru</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">
                    <i class="fa fa-book text-blue-600"></i>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($bookRequests as $request)
                    <div class="flex items-center justify-between gap-4 bg-slate-50 border border-slate-100 rounded-2xl p-4 hover:bg-slate-100 transition">
                        <div>
                            <h3 class="font-semibold text-slate-800">
                                {{ $request->title ?? 'Judul kosong' }}
                            </h3>
                            <p class="text-sm text-slate-500 mt-1">Permintaan penambahan buku</p>
                        </div>

                        <span class="text-xs font-semibold px-3 py-2 rounded-full bg-yellow-100 text-yellow-700 whitespace-nowrap">
                            {{ $request->status ?? 'pending' }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-10 text-slate-400">
                        <i class="fa fa-folder-open text-3xl mb-3"></i>
                        <p>Tidak ada request buku</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Category Requests</h2>
                    <p class="text-sm text-slate-500 mt-1">Daftar permintaan kategori terbaru</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">
                    <i class="fa fa-tags text-green-600"></i>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($categoryRequests as $request)
                    <div class="flex items-center justify-between gap-4 bg-slate-50 border border-slate-100 rounded-2xl p-4 hover:bg-slate-100 transition">
                        <div>
                            <h3 class="font-semibold text-slate-800">
                                {{ $request->name ?? 'Nama kategori kosong' }}
                            </h3>
                            <p class="text-sm text-slate-500 mt-1">Permintaan kategori baru</p>
                        </div>

                        <span class="text-xs font-semibold px-3 py-2 rounded-full bg-yellow-100 text-yellow-700 whitespace-nowrap">
                            {{ $request->status ?? 'pending' }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-10 text-slate-400">
                        <i class="fa fa-folder-open text-3xl mb-3"></i>
                        <p>Tidak ada request kategori</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Review Section -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">📋 Review Terbaru Pengguna</h2>
            <p class="text-slate-500 text-sm mt-1">Pantau review terbaru dari pengguna</p>
        </div>
        <div class="hidden md:block w-24 h-1 bg-green-500 rounded-full"></div>
    </div>

    @isset($latestReviews)
        @if($latestReviews->isEmpty())
            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-10 text-center text-slate-400">
                <i class="fa fa-comments text-4xl mb-4"></i>
                <p class="text-lg">Belum ada review dari pengguna</p>
            </div>
        @else
            <div class="space-y-5">
                @foreach($latestReviews as $review)
                    <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fa fa-user text-green-600 text-lg"></i>
                                </div>

                                <div>
                                    <h3 class="text-lg font-bold text-slate-800 mb-1">
                                        {{ $review->user->name ?? 'Pengguna' }}
                                    </h3>

                                    <p class="text-slate-600 mb-3">
                                        Mereview buku
                                        <span class="font-semibold text-green-600">
                                            {{ $review->book->judul ?? 'Buku' }}
                                        </span>
                                    </p>

                                    <div class="inline-flex items-center gap-2 bg-yellow-50 border border-yellow-100 px-3 py-2 rounded-xl text-yellow-700 text-sm font-semibold">
                                        <i class="fa fa-star text-yellow-500"></i>
                                        Rating: {{ $review->rating }}/5
                                    </div>
                                </div>
                            </div>

                            <button
                                class="view-review-btn px-5 py-3 rounded-2xl bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 font-semibold text-sm transition"
                                data-review-id="{{ $review->id }}"
                                data-user-name="{{ $review->user->name }}"
                                data-book-title="{{ $review->book->judul }}"
                                data-rating="{{ $review->rating }}"
                                data-comment="{{ $review->komentar }}"
                                data-date="{{ $review->created_at->format('d M Y') }}"
                                data-route="{{ route('petugas.review.destroy', $review->id) }}">
                                Lihat Review
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endisset
</div>

<!-- Modal -->
<div id="reviewModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-[32px] shadow-2xl max-w-xl w-full p-8 relative border border-slate-100">

        <button type="button" class="absolute top-5 right-6 text-slate-400 hover:text-slate-700 text-3xl close-modal-btn">
            &times;
        </button>

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
            <button type="button" class="close-modal-btn flex-1 bg-slate-200 hover:bg-slate-300 text-slate-700 py-3 rounded-2xl font-semibold transition">
                Tutup
            </button>

            <form id="deleteReviewForm" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-2xl font-semibold transition">
                    Hapus Review
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('reviewModal');
        const closeButtons = document.querySelectorAll('.close-modal-btn');
        const deleteForm = document.getElementById('deleteReviewForm');

        document.querySelectorAll('.view-review-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('reviewBookTitle').textContent = this.dataset.bookTitle || '-';
                document.getElementById('reviewUserName').textContent = this.dataset.userName || '-';
                document.getElementById('reviewRating').textContent = this.dataset.rating ? this.dataset.rating + '/5' : '-';
                document.getElementById('reviewDate').textContent = this.dataset.date || '-';
                document.getElementById('reviewComment').textContent = this.dataset.comment || '-';
                deleteForm.action = this.dataset.route;
                modal.classList.remove('hidden');
            });
        });

        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                modal.classList.add('hidden');
            });
        });

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
@endsection

