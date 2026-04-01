@extends('layouts.app-dashboardstaff')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Tambah Kategori</h1>
    <form action="{{ route('petugas.categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
            @error('name')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded">Kirim Request</button>
        <a href="{{ route('petugas.categories.index') }}" class="ml-2 text-gray-600">Kembali</a>
    </form>
</div>
@endsection