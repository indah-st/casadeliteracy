@extends('layouts.app-user')

@section('content')

<div class="max-w-3xl mx-auto py-10">

<div class="bg-white p-6 rounded-xl shadow">

<h2 class="text-2xl font-bold mb-6">Form Peminjaman Buku</h2>

<div class="flex gap-6">

{{-- Cover --}}
<img src="{{ asset('storage/'.$book->cover) }}"
     class="w-40 h-60 object-cover rounded">

<div>

<h3 class="text-xl font-semibold">{{ $book->judul }}</h3>

<p class="text-gray-600">Penulis: {{ $book->penulis }}</p>
<p class="text-gray-600">Penerbit: {{ $book->penerbit }}</p>
<p class="text-gray-600 mb-4">Stok: {{ $book->stok }}</p>

<form action="{{ route('borrow.store') }}" method="POST">
@csrf

<input type="hidden" name="book_id" value="{{ $book->id }}">

<div class="mb-4">
<label class="block font-semibold">Tanggal Pinjam</label>
<input type="date" name="tanggal_pinjam"
       class="w-full border rounded p-2" required>
</div>

<div class="mb-4">
<label class="block font-semibold">Tanggal Kembali</label>
<input type="date" name="tanggal_kembali"
       class="w-full border rounded p-2" required>
</div>

<button type="submit" class="bg-green-600 text-white px-5 py-2 rounded">
    Pinjam Buku
</button>

</form>

</div>

</div>

</div>

</div>

@endsection