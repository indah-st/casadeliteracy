<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Ajukan Request Buku</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('petugas.book_requests.store') }}" method="POST" class="space-y-4 mb-6 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block mb-1">Judul Buku</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded p-2" required>
            @error('judul')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block mb-1">Penulis</label>
            <input type="text" name="penulis" value="{{ old('penulis') }}" class="w-full border rounded p-2" required>
            @error('penulis')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block mb-1">Penerbit</label>
            <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="w-full border rounded p-2" required>
            @error('penerbit')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Tahun</label>
                <input type="number" name="tahun" value="{{ old('tahun') }}" class="w-full border rounded p-2" required>
                @error('tahun')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block mb-1">Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}" class="w-full border rounded p-2" required>
                @error('stok')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="block mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block mb-1">Sinopsis</label>
            <textarea name="sinopsis" class="w-full border rounded p-2">{{ old('sinopsis') }}</textarea>
        </div>

        <div>
            <label class="block mb-1">Jumlah Halaman</label>
            <input type="number" name="jumlah_halaman" value="{{ old('jumlah_halaman') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Cover URL (opsional)</label>
            <input type="text" name="cover" value="{{ old('cover') }}" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Kirim Request</button>
    </form>

    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Daftar Request Buku</h2>
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">No</th>
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Aksi</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookRequests as $request)
                <tr>
                    <td class="border p-2">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $request->judul }}</td>
                    <td class="border p-2">{{ $request->category->name ?? '-' }}</td>
                    <td class="border p-2">{{ ucfirst($request->action) }}</td>
                    <td class="border p-2 capitalize">{{ $request->status }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="border p-2 text-center">Belum ada request.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>