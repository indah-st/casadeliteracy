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
            <div class="w-20 h-20 bg-green-400  rounded-3xl mx-auto mb-4 flex items-center justify-center">
                <i class="fas fa-star text-2xl text-white"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Beri Review Buku</h1>
            <p class="text-gray-500">Bagikan pengalamanmu membaca buku ini</p>
        </div>

        {{-- INFO BUKU --}}
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 p-6 rounded-2xl mb-8">
            <h3 class="font-semibold text-gray-800 mb-2">{{ $book->judul ?? $book->title }}</h3>
            <p class="text-sm text-gray-600">{{ $book->author ?? '-' }}</p>
        </div>

        <form method="POST" action="{{ url('book/' . $book->id . '/review') }}" class="space-y-6">
            @csrf
            
            {{-- RATING --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Rating ⭐</label>
                <div class="grid grid-cols-5 gap-2">
                    @for($i=1; $i<=5; $i++)
                        <label class="flex flex-col items-center p-3 border-2 border-gray-200 rounded-xl hover:border-purple-300 hover:shadow-md transition cursor-pointer group {{ old('rating') == $i ? 'border-purple-400 bg-purple-50 shadow-sm' : '' }}">
                            <input type="radio" name="rating" value="{{ $i }}" 
                                   class="sr-only peer" required {{ old('rating') == $i ? 'checked' : '' }}>
                            <div class="text-2xl {{ old('rating') == $i ? 'text-yellow-400' : 'text-gray-300 group-hover:text-yellow-400 peer-checked:text-yellow-400 transition' }}">
                                ⭐
                            </div>
                            <span class="text-xs font-medium text-gray-600 mt-1">{{ $i }}</span>
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
                        class="flex-1 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection