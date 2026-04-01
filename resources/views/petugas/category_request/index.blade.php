@extends('layouts.app-dashboardstaff')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
        Daftar Request Kategori
    </h1>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded-xl shadow-sm text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                
                <thead class="bg-green-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4 text-left">Nama Kategori</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $request)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 text-center font-medium">
                                {{ $loop->iteration }}
                            </td>

                            <td class="py-3 px-4">
                                {{ $request->name }}
                            </td>

                            <td class="py-3 px-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($request->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($request->status == 'approved') bg-green-100 text-green-700
                                    @elseif($request->status == 'rejected') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-600
                                    @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>

                            <td class="py-3 px-4 text-center text-gray-600">
                                {{ ucfirst($request->action ?? 'create') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-4 text-center text-gray-500">
                                Belum ada request kategori
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection