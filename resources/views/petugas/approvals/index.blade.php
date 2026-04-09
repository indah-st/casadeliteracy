@extends('layouts.app-dashboardstaff')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Persetujuan Peminjaman & Pengembalian</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Buku</th>
                    <th class="px-4 py-2">Pemohon</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Tanggal Pinjam</th>
                    <th class="px-4 py-2">Tanggal Kembali</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $b)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $b->book->judul ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $b->user->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $b->user->address ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $b->tanggal_pinjam }}</td>
                    <td class="px-4 py-2">{{ $b->tanggal_kembali }}</td>
                    <td class="px-4 py-2 capitalize">{{ $b->status }}</td>
                    <td class="px-4 py-2">
                        @if($b->status == 'pending')
                        <form action="{{ route('petugas.approve', $b->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button class="bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                        </form>
                        <form action="{{ route('petugas.reject', $b->id) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            <button class="bg-red-600 text-white px-3 py-1 rounded">Reject</button>
                        </form>
                        @elseif($b->status == 'menunggu_pengembalian')
                        <form action="{{ route('petugas.approveReturn', $b->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button class="bg-blue-600 text-white px-3 py-1 rounded">Approve Return</button>
                        </form>
                        <form action="{{ route('petugas.rejectReturn', $b->id) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            <button class="bg-yellow-600 text-white px-3 py-1 rounded">Reject Return</button>
                        </form>
                        @else
                        -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center p-4">Tidak ada pengajuan peminjaman atau pengembalian saat ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection