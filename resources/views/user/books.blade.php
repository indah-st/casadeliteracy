@extends('layouts.app-user')

@section('content')

{{-- HEADER --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Daftar Buku</h1>
    <p class="text-sm text-gray-500">Temukan buku yang ingin kamu baca</p>
</div>

{{-- GRID BUKU --}}
@if($books->isEmpty())

<p class="text-gray-500">Belum ada buku tersedia.</p>

@else

<div class="grid grid-cols-8 gap-y-10 justify-items-center">

@foreach($books as $book)

<div class="group w-36">

{{-- BUKU --}}
<div class="relative">

{{-- spine buku --}}
<div class="absolute left-0 top-0 h-full w-1.5 bg-gray-300 rounded-l-md shadow-inner"></div>

{{-- cover --}}
<div class="aspect-[2/3] overflow-hidden rounded-r-md shadow-md bg-white group-hover:shadow-xl transition duration-300">

@if($book->cover)

<img src="{{ asset('storage/'.$book->cover) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

@else

<div class="flex items-center justify-center h-full bg-gray-200 text-gray-400 text-xs">
No Cover
</div>

@endif

</div>

</div>

{{-- INFO --}}
<div class="mt-3">

<h3 class="text-sm font-semibold text-gray-800 leading-snug line-clamp-2">{{ $book->judul }}</h3>

<p class="text-xs text-gray-500 mt-1">{{ $book->penulis ?? 'Penulis tidak diketahui' }}</p>

<div class="flex items-center justify-between mt-2">

<span class="text-xs text-gray-500">Stok {{ $book->stok }}</span>

@php
    $rating = $book->reviews->avg('rating') ?? 0;
@endphp

<div class="flex items-center">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= round($rating))
            <i class="fa fa-star text-yellow-400"></i>
        @else
            <i class="fa fa-star text-gray-300"></i>
        @endif
    @endfor

    <span class="ml-2 text-sm text-gray-600">({{ number_format($rating, 1) }})</span>
</div>

</div>

<a href="{{ route('books.show',$book->id) }}" class="block mt-3 text-center text-sm bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">Detail</a>

</div>

</div>

@endforeach

</div>

@endif

@endsection
