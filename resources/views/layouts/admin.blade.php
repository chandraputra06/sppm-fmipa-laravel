<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin • {{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white min-h-screen p-5 space-y-5">
        <h1 class="font-bold text-xl mb-5">Admin Panel</h1>

        <nav class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block hover:text-yellow-300">Dashboard</a>
            <a href="#" class="block hover:text-yellow-300">Data Prestasi</a>
            <a href="#" class="block hover:text-yellow-300">Import Excel</a>
            <a href="#" class="block hover:text-yellow-300">Komentar</a>
        </nav>

        <form action="{{ route('admin.logout') }}" method="POST" class="mt-10">
            @csrf
            <button class="bg-red-600 w-full py-2 rounded hover:bg-red-700">Logout</button>
        </form>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-6">{{ $title ?? 'Dashboard' }}</h1>
        @yield('content')
    </main>

</div>

</body>
</html>
