<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-10 rounded-xl shadow-md w-[30rem]">
    <h2 class="text-2xl font-bold text-center text-green-600 mb-4">Login Petugas</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('petugas.petugas.login.submit') }}" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Email"
               class="w-full border p-3 rounded focus:outline-none focus:ring-2 focus:ring-green-400" required>

        <input type="password" name="password" placeholder="Password"
               class="w-full border p-3 rounded focus:outline-none focus:ring-2 focus:ring-green-400" required>

        <button type="submit"
                class="w-full bg-green-500 text-white py-3 rounded hover:bg-green-600 transition">
            Login
        </button>
    </form>
</div>

</body>
</html>