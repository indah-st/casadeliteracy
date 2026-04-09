@extends('layouts.app-user')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 grid md:grid-cols-3 gap-8">

        {{-- COVER --}}
        <div class="flex justify-center">
            <img 
                src="{{ $book->cover ? asset('storage/'.$book->cover) : 'https://via.placeholder.com/300x450' }}" 
                alt="{{ $book->judul }}"
                class="w-64 h-[380px] object-cover rounded-xl shadow-md"
            >
        </div>

        {{-- DETAIL BUKU --}}
        <div class="md:col-span-2 flex flex-col">

            {{-- Judul --}}
            <h1 class="text-3xl font-bold text-gray-800 mb-3">
                {{ $book->judul }}
            </h1>

            {{-- Penulis --}}
            <p class="text-lg text-gray-600 mb-6">
                oleh <span class="font-semibold">{{ $book->penulis }}</span>
            </p>

            {{-- INFO GRID --}}
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-700 mb-6">

                <div>
                    <span class="font-semibold">Penerbit:</span><br>
                    {{ $book->penerbit }}
                </div>

                <div>
                    <span class="font-semibold">Tahun Terbit:</span><br>
                    {{ $book->tahun }}
                </div>

                <div>
                    <span class="font-semibold">Jumlah Halaman:</span><br>
                    {{ $book->jumlah_halaman ?? '-' }} halaman
                </div>

                <td>
                    @if($book->categories->isNotEmpty())
                        {{ $book->categories->pluck('name')->join(', ') }}
                    @else
                        -
                    @endif
                </td>

                <div>
                    <span class="font-semibold">Stok Buku:</span><br>
                    {{ $book->stok }}
                </div>

            </div>

            {{-- SINOPSIS --}}
            <div class="mb-8">
                <h3 class="font-semibold text-lg mb-2">Sinopsis</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ $book->sinopsis ?? 'Sinopsis belum tersedia.' }}
                </p>
            </div>
            {{-- RATING & REVIEWS --}}
    <div class="mb-8 bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 p-6 rounded-2xl">
        <div class="flex items-center gap-3 mb-4">
            {{-- RATING AVERAGE --}}
            <div class="flex items-center gap-1">
                <div class="flex text-yellow-400 text-xl">
                    @php
                        $avgRating = $reviews->avg('rating') ?? 0;
                        $fullStars = floor($avgRating);
                        $hasHalfStar = $avgRating - $fullStars >= 0.5;
                    @endphp
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $fullStars)
                            ⭐
                        @elseif($i == $fullStars + 1 && $hasHalfStar)
                            ⭒
                        @else
                            ☆
                        @endif
                    @endfor
                </div>
                <span class="font-bold text-2xl text-gray-800">{{ number_format($avgRating, 1) }}</span>
                <span class="text-sm text-gray-500">({{ $reviews->count() }} ulasan)</span>
            </div>
        </div>

        {{-- LIST REVIEWS TERBARU --}}
        @if($reviews->count() > 0)
            <div class="space-y-4 max-h-64 overflow-y-auto">
                @foreach($reviews as $review)
                    <div class="flex gap-3 p-3 bg-white rounded-xl border border-gray-100">
                        <div class="flex items-center gap-1 text-yellow-400 text-lg">
                            @for($i = 1; $i <= $review->rating; $i++) ⭐ @endfor
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-800 truncate">{{ $review->user->name }}</p>
                            @if($review->komentar)
                                <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $review->komentar }}</p>
                            @endif
                            <p class="text-xs text-gray-400 mt-1">{{ $review->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4 italic">Belum ada ulasan. Jadilah yang pertama!</p>
        @endif
    </div>
    {{-- END RATING --}}

            {{-- BUTTON --}}
            <div class="flex gap-4">

                {{-- KOLEKSI --}}
                <form action="{{ route('books.addToCollection', $book->id) }}" method="POST">
                    @csrf
                    <button 
                        class="px-5 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition">
                        + Koleksi Saya
                    </button>
                </form>

                {{-- PINJAM --}}
                <form action="{{ route('borrow.create', $book->id) }}">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <button 
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition">
                        Pinjam Buku
                    </button>
                </form>

                {{-- REVIEW --}}
                @php
                    $hasCompletedBorrowing = Auth::user()->borrowings()
                        ->where('book_id', $book->id)
                        ->where('status', 'selesai')
                        ->exists();
                    $hasReviewed = Auth::user()->reviews()
                        ->where('book_id', $book->id)
                        ->exists();
                @endphp
                @if($hasCompletedBorrowing && !$hasReviewed)
                    <a href="{{ route('book.review', $book->id) }}" 
                        class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-semibold transition">
                        ⭐ Beri Ulasan
                    </a>
                @endif

            </div>

        </div>

    </div>

</div>
@endsection