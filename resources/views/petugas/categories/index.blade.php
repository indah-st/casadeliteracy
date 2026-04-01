@extends('layouts.app-dashboardstaff')

@section('content')
<div class="min-h-[75vh] flex flex-col items-center py-8 px-4 w-full">

    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Kategori Buku</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-6 w-full max-w-xl bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow-sm text-center">
            {{ session('success') }}
        </div>
    @endif
    

    {{-- Link + Form --}}
    <div class="mb-10 w-full max-w-3xl flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">
        
        <a href="{{ route('petugas.category_requests.index') }}" 
           class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition shadow-sm text-center">
            Lihat Status Request
        </a>

        <form action="{{ route('petugas.categories.store') }}" method="POST" 
              class="w-full sm:w-auto bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm">
            @csrf
            <div class="flex gap-2 items-center">
                <input type="text" name="name" placeholder="Tambah kategori..."
                    value="{{ old('name') }}"
                    class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-green-400"
                    required>

                <button type="submit" 
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Ajukan
                </button>
            </div>

            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </form>
    </div>

    {{-- Daftar Kategori --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full max-w-5xl">
        @foreach($categories as $category)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5 
                        hover:shadow-md hover:-translate-y-1 transition duration-300 flex flex-col justify-between">

                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    {{ $category->name }}
                </h3>

                <div class="flex justify-between text-sm font-medium">
                    {{-- Request Edit --}}
                    <a href="{{ route('petugas.category_requests.create') }}?action=update&category_id={{ $category->id }}"
                        class="text-blue-500 hover:text-blue-700 transition">
                        Edit
                    </a>

                    {{-- Request Delete --}}
                    <a href="{{ route('petugas.category_requests.create') }}?action=delete&category_id={{ $category->id }}"
                        class="text-red-500 hover:text-red-700 transition">
                        Hapus
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection