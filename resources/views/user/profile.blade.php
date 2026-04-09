@extends('layouts.app-user')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT: PROFILE --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-6 border-b pb-3">
                👤 Profile Saya
            </h2>

            <form id="profile-form" action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Nama
                    </label>
                    <input id="profile-name" type="text" name="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none transition">
                </div>

                {{-- Alamat --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Alamat
                    </label>
                    <input id="profile-address" type="text" name="address"
                        value="{{ old('address', auth()->user()->address) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none transition">
                </div>

                {{-- Email --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Email
                    </label>
                    <input id="profile-email" type="email" name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none transition">
                </div>

                <button
                    class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-2.5 rounded-xl font-medium shadow hover:shadow-md hover:scale-[1.01] transition">
                    Update Profile
                </button>
            </form>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition">
                    Logout
                </button>
            </form>
        </div>

        {{-- RIGHT: HISTORY --}}
<div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-6 border-b pb-3">
        📚 Riwayat Peminjaman
    </h2>

    @if($borrowings->isEmpty())
        <div class="text-center py-10 text-gray-400">
            <p class="text-sm">Belum ada riwayat peminjaman</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($borrowings as $borrow)
                <div class="flex items-start justify-between gap-4 p-4 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-xl transition group">
                    
                    {{-- LEFT INFO --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-800 truncate">
                            {{ $borrow->book->judul ?? 'Buku tidak ditemukan' }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $borrow->created_at->format('d M Y') }}
                        </p>
                    </div>

                    {{-- STATUS --}}
                    <div class="flex flex-col items-end gap-2 min-w-[100px]">
                        @if($borrow->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                                Pending
                            </span>
                        @elseif($borrow->status == 'dipinjam')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                Dipinjam
                            </span>
                        @elseif($borrow->status == 'menunggu_pengembalian')
                            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-medium">
                                Menunggu
                            </span>
                        @elseif($borrow->status == 'selesai')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                ✅ Selesai
                            </span>
                        @elseif($borrow->status == 'dikembalikan')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                ✅ Dikembalikan
                            </span>
                        @elseif($borrow->status == 'ditolak')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                Ditolak
                            </span>
                        @endif

                        {{-- TOMBOL AJUKAN PENGEMBALIAN --}}
                        @if($borrow->status == 'dipinjam')
                            <form action="{{ route('user.peminjaman.return', $borrow->id) }}" method="POST" class="inline">
                                @csrf
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs font-medium transition">
                                    📤 Kembalikan
                                </button>
                            </form>
                        @elseif($borrow->status == 'menunggu_pengembalian')
                            <span class="text-xs text-orange-600 font-medium">⏳ Menunggu admin</span>

                        {{-- TOMBOL REVIEW - HANYA UNTUK BUKU YANG SUDAH SELESAI --}}
                        @elseif($borrow->status == 'selesai')
                            @if(!$borrow->hasReviewed())
                            <a href="/book/{{ $borrow->book_id }}/review" 
                            class="bg-green-500 text-white px-4 py-2 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 whitespace-nowrap">
                                ✨ Beri Review
                            </a>
                            @else
                                <span class="bg-gradient-to-r from-green-400 to-green-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                                    ⭐ Sudah Review
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileForm = document.getElementById('profile-form');
        const nameInput = document.getElementById('profile-name');
        const emailInput = document.getElementById('profile-email');

        let timeout;

        function debounceSubmit() {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                profileForm.submit();
            }, 700);
        }

        if (nameInput) {
            nameInput.addEventListener('input', debounceSubmit);
        }

        if (emailInput) {
            emailInput.addEventListener('input', debounceSubmit);
        }
    });
</script>

@endsection