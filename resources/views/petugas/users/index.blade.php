@extends('layouts.app-dashboardstaff')

@section('content')
<div class="p-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-green-600 flex items-center gap-2">
            <i class="fa fa-users"></i> Data User
        </h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-green-600 text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Alamat</th>
                    <th class="p-4 text-left">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($users as $user)
                <tr class="border-b hover:bg-green-50 transition">
                    <td class="p-4">{{ $loop->iteration }}</td>
                    <td class="p-4 font-medium">{{ $user->name }}</td>
                    <td class="p-4">{{ $user->email }}</td>
                    <td class="p-4">{{ $user->address ?? '-' }}</td>
                    <td class="p-4">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
</tbody>
            
</div>
@endsection