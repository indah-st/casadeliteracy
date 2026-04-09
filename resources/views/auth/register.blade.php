<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-100 via-green-200 to-green-300 min-h-screen flex items-center justify-center">

<div class="bg-white p-20 rounded-2xl w-[40rem] shadow-[0_10px_30px_rgba(34,197,94,0.4)]">
    <h2 class="text-3xl font-bold text-center mb-2 text-green-600">Register Akun</h2>
    <p class="text-center text-gray-500 mb-8 text-sm">
        Buat akun baru untuk mulai menggunakan layanan
    </p>

    <form method="POST" action="/register" class="space-y-5">
        @csrf
        <input type="text" name="name" placeholder="Nama"
            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400" required>

        <input type="email" name="email" placeholder="Email"
            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400" required>

        <label class="block text-sm font-medium text-gray-700">Kota</label>
        <select name="city" required
            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400">
            <option value="" disabled selected>Pilih kota</option>
            <option value="Jakarta Pusat" {{ old('city') === 'Jakarta Pusat' ? 'selected' : '' }}>Jakarta Pusat</option>
            <option value="Jakarta Utara" {{ old('city') === 'Jakarta Utara' ? 'selected' : '' }}>Jakarta Utara</option>
            <option value="Jakarta Timur" {{ old('city') === 'Jakarta Timur' ? 'selected' : '' }}>Jakarta Timur</option>
            <option value="Jakarta Selatan" {{ old('city') === 'Jakarta Selatan' ? 'selected' : '' }}>Jakarta Selatan</option>
            <option value="Jakarta Barat" {{ old('city') === 'Jakarta Barat' ? 'selected' : '' }}>Jakarta Barat</option>
        </select>
        @error('city')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror

        <label class="block text-sm font-medium text-gray-700">Detail Alamat</label>
        <input type="text" name="address_detail" placeholder="Contoh: Jl. Sudirman No. 123, RT 01/RW 02, Kel. Tanah Abang, Kec. Tanah Abang, Jakarta Pusat"
            value="{{ old('address_detail') }}"
            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400" required>
        @error('address_detail')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror

        <p class="text-xs text-gray-500 mt-1">
            <strong>Note:</strong> Registrasi hanya diperbolehkan untuk wilayah Jakarta (Jakarta Pusat, Jakarta Utara, Jakarta Timur, Jakarta Selatan, Jakarta Barat). Perpustakaan Casa De Literacy berlokasi di Jakarta Pusat - Cikini.
        </p>

        <input type="password" name="password" placeholder="Password"
            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400" required>

        <button type="submit"
            class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition duration-300 shadow-md">
            Register
        </button>
    </form>

    <p class="text-center mt-6 text-sm text-gray-600">
        Sudah punya akun?
        <a href="/login" class="text-green-600 font-semibold hover:underline">Login</a>
    </p>
</div>

</body>
</html>
