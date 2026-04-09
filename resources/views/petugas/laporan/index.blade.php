@extends('layouts.app-dashboardstaff')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Laporan Peminjaman</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-gray-600">Laporan Peminjaman selesai</p>
            <a href="{{ route('petugas.laporan.printAll') }}" target="_blank" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-blue-700 transition">
                <i class="fa fa-print"></i> Cetak Semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wide">
                        <th class="text-left p-4">Nama</th>
                        <th class="text-left p-4">Judul Buku</th>
                        <th class="text-left p-4">Tanggal Pinjam</th>
                        <th class="text-left p-4">Tanggal Kembali</th>
                        <th class="text-center p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach($borrowings as $b)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 font-medium">{{ $b->user->name }}</td>
                        <td class="p-4">{{ $b->book->judul }}</td>
                        <td class="p-4">{{ $b->tanggal_pinjam }}</td>
                        <td class="p-4">{{ $b->tanggal_kembali }}</td>
                        <td class="p-4 text-center">
                            <a href="{{ route('petugas.laporan.print', $b->id) }}" target="_blank" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-blue-700 transition">
                                <i class="fa fa-print"></i> Print
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection