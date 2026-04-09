<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Dashboard</title>

    {{-- Tailwind --}}
    @vite('resources/css/app.css')
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>

         body{
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    </style>
</head>
<body class="bg-gray-50">

    {{-- TOPBAR --}}
    <div class="bg-white shadow-sm px-7 py-6 flex items-center justify-between sticky top-0 z-70">

        {{-- kiri --}}
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/Logo.jpeg') }}" alt="Logo" class="h-26 w-26">
        </div>

        {{-- tengah search --}}
        <div class="w-2/3">
            <form action="{{ route('user.books') }}" method="GET" class="w-full">
                <input type="text"
                       name="search"
                       placeholder="Cari buku..."
                       class="w-full border rounded-full px-6 py-4 focus:outline-none focus:ring-2 focus:ring-green-500">
            </form>
        </div>

        {{-- kanan --}}
        <div class="flex items-center gap-16">

        {{--dashboard--}}
            <a href="/user/dashboard" class="text-gray-600 hover:text-green-600 text-5xl leading-none align-middle transition transform hover:scale-125">
                    📋
            </a>

            {{-- koleksi --}}
            <a href="{{ route('user.collections.index') }}" class="text-gray-600 hover:text-green-600 text-5xl leading-none align-middle transition transform hover:scale-125">
                📚
            </a>

            {{-- profile --}}
           <a href="{{ route('user.profile') }}" class="text-gray-600 hover:text-green-600 text-5xl leading-none align-middle transition transform hover:scale-125">
                👤
            </a>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="w-full px-6 py-6">
        @yield('content')
    </div>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>