@extends('layouts.app-dashboardstaff')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Data Peminjaman</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">User</th>
                    <th class="border border-gray-300 px-4 py-2">Buku</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal Pinjam</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal Kembali</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $borrowing)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $borrowing->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $borrowing->user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $borrowing->book->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $borrowing->tanggal_pinjam }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $borrowing->tanggal_kembali }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $borrowing->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection