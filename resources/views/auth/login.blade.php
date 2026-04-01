<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-100 via-green-200 to-green-300 min-h-screen flex items-center justify-center">

<div class="bg-white p-20 rounded-2xl w-[40rem] shadow-[0_20px_30px_rgba(34,197,94,0.4)]">
    <h2 class="text-3xl font-bold text-center mb-2 text-green-600">Welcome Back!</h2>
    <p class="text-center text-gray-500 mb-8 text-sm">
        Silakan login untuk melanjutkan
    </p>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.login') }}" class="space-y-5">
    @csrf

    <input type="email" name="email" placeholder="Email"
        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400" required>

    <input type="password" name="password" placeholder="Password"
        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400" required>

    <button type="submit"
        class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition duration-300 shadow-md">
        Login
    </button>

    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-2 rounded mt-2 text-sm">
            {{ session('error') }}
        </div>
    @endif
</form>

    <p class="text-center mt-6 text-sm text-gray-600">
        Belum punya akun?
        <a href="/register" class="text-green-600 font-semibold hover:underline">Register</a>
    </p>
</div>

</body>
</html>
