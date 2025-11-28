<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SPPM FMIPA' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="font-bold text-lg text-blue-700">SPPM FMIPA</a>

            <div class="flex space-x-6">
                <a href="/" class="hover:text-blue-600">Beranda</a>
                <a href="/prestasi" class="hover:text-blue-600">Prestasi</a>

                @auth
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="text-red-500 hover:underline">
                            Logout ({{ auth()->user()->nama_mahasiswa }})
                        </button>
                    </form>
                @else
                    <a href="/login" class="hover:text-blue-600">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="max-w-6xl mx-auto p-6">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="mt-10 bg-gray-900 text-white text-center py-3 text-sm">
        © {{ date('Y') }} FMIPA Udayana — Sistem Pendataan Prestasi Mahasiswa
    </footer>

</body>
</html>
