@extends('layouts.app-dashboardstaff')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">
        @if($action == 'create')
            Tambah Request Kategori
        @elseif($action == 'update')
            Request Edit Kategori
        @else
            Request Hapus Kategori
        @endif
    </h1>

    <form action="{{ route('petugas.category_requests.store') }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="{{ $action }}">
        @if($action !== 'create')
            <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}">
        @endif

        <div class="mb-4">
            <label>Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name ?? old('name') }}" class="w-full border p-2 rounded" {{ $action == 'delete' ? 'readonly' : '' }}>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            @if($action == 'create')
                Kirim Request Tambah
            @elseif($action == 'update')
                Kirim Request Edit
            @else
                Kirim Request Hapus
            @endif
        </button>
    </form>
</div>

@endsection