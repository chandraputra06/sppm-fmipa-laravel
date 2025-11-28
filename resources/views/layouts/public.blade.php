<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPPM FMIPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    
    <!-- NAV -->
    <nav class="bg-white shadow p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="font-bold text-lg">SPPM FMIPA</a>

            <div class="flex items-center gap-4">
                <a href="/prestasi" class="hover:text-blue-600">Daftar Prestasi</a>

                @auth
                    <span class="text-sm text-gray-700">Halo, {{ auth()->user()->nama_mahasiswa }}</span>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="text-red-500 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="/login" class="text-blue-600 hover:underline">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="max-w-6xl mx-auto p-6">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white p-4 text-center text-sm">
        Sistem Pendataan Prestasi Mahasiswa - FMIPA Udayana © {{ date('Y') }}
    </footer>

</body>
</html>
