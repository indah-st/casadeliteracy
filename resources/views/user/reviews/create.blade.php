@extends('layouts.app-user')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-6">
    
    {{-- SUCCESS/ERROR ALERT --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
        
        <div class="text-center mb-8">
            <div class="flex justify-center mb-6">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}" class="w-40 h-56 object-cover rounded-2xl shadow-lg">
                @else
                    <div class="w-40 h-56 bg-gradient-to-br from-gray-200 to-gray-300 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-book text-4xl text-gray-400"></i>
                    </div>
                @endif
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $book->judul ?? $book->title }}</h1>
            <p class="text-gray-600 mb-1">Penulis: <span class="font-semibold">{{ $book->penulis ?? 'Tidak diketahui' }}</span></p>
            <p class="text-gray-500 text-sm">Bagikan pengalamanmu membaca buku ini</p>
        </div>

        <form method="POST" action="{{ url('book/' . $book->id . '/review') }}" class="space-y-6">
            @csrf
            
            {{-- RATING --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Rating ⭐</label>
                
                <!-- Rating Display -->
                <div class="mb-4 p-4 bg-green-50 rounded-2xl border border-green-200">
                    <p class="text-center text-lg font-bold text-green-700">
                        <span id="ratingDisplay">Pilih rating Anda</span>
                    </p>
                </div>

                <!-- Rating Stars -->
                <div class="grid grid-cols-5 gap-3">
                    @for($i=1; $i<=5; $i++)
                        <label class="flex flex-col items-center p-4 border-2 border-gray-300 rounded-2xl hover:border-green-400 hover:shadow-lg transition cursor-pointer group {{ old('rating') == $i ? 'border-green-500 bg-green-50 shadow-md' : '' }}">
                            <input type="radio" name="rating" value="{{ $i }}" 
                                   class="sr-only peer" required {{ old('rating') == $i ? 'checked' : '' }}
                                   onchange="updateRatingDisplay({{ $i }})">
                            <div class="text-4xl font-bold {{ old('rating') == $i ? 'text-yellow-400' : 'text-gray-300 group-hover:text-yellow-400 peer-checked:text-yellow-400 transition' }}">
                                ⭐
                            </div>
                            <span class="text-sm font-bold text-gray-700 mt-2">{{ $i }}</span>
                        </label>
                    @endfor
                </div>
                @error('rating')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- KOMENTAR --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Komentar</label>
                <textarea name="komentar" 
                          rows="5" 
                          placeholder="Ceritakan apa yang kamu sukai dari buku ini..."
                          class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-purple-400 focus:border-transparent transition resize-vertical">{{ old('komentar') }}</textarea>
                @error('komentar')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTONS --}}
            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <a href="{{ url('/user/profile') }}" 
                   class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-4 px-6 rounded-2xl text-center transition shadow-sm">
                    ← Kembali ke Profile
                </a>
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Review
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function updateRatingDisplay(rating) {
    const display = document.getElementById('ratingDisplay');
    const labels = ['Buruk', 'Kurang Baik', 'Cukup', 'Bagus', 'Sangat Bagus'];
    display.textContent = `Rating: ${rating}/5 - ${labels[rating - 1]} ⭐`;
}

// Initialize on page load if rating already selected
document.addEventListener('DOMContentLoaded', function() {
    const selectedRating = document.querySelector('input[name="rating"]:checked');
    if (selectedRating) {
        updateRatingDisplay(selectedRating.value);
    }
});
</script>
@endsection