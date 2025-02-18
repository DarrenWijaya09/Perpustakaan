<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital - {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-[Poppins] bg-gray-50">
    <!-- Navigation -->
<!-- Navigation -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600">Libra</span>
                    <span class="text-2xl font-bold text-gray-800">{Book}</span>
                    <span class="text-2xl font-bold text-blue-600">Ry</span>
                </a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-600 font-medium">Halo, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2">Login Admin</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Login Siswa</a>
                @endauth
            </div>
        </div>
    </div>
</nav>


    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-500 to-blue-600">
        <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white sm:text-5xl md:text-6xl">
                    Selamat Datang di Sistem Perpustakaan Digital
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-blue-100 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Kelola peminjaman buku secara digital dengan mudah dan efisien. Akses ribuan koleksi buku dari mana saja.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="{{ route('student.dashboard') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 md:py-4 md:text-lg md:px-10">
                            Mulai Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kenapa Memilih Sistem Kami?
                </h2>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Feature 1 -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Akses Mudah</h3>
                    <p class="mt-2 text-gray-600">Pinjam dan kembalikan buku secara online dengan beberapa klik saja</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Real-time Tracking</h3>
                    <p class="mt-2 text-gray-600">Pantau status peminjaman secara real-time</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Keamanan Data</h3>
                    <p class="mt-2 text-gray-600">Sistem terenkripsi untuk keamanan data pengguna</p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-orange-500 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Laporan Lengkap</h3>
                    <p class="mt-2 text-gray-600">Generate laporan peminjaman secara otomatis</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    <span class="block">Siap memulai?</span>
                </h2>
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-md shadow">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Login Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-base text-gray-400">
                    &copy; {{ date('Y') }} Perpustakaan Digital. All rights reserved.
                </p>
                <div class="mt-4">
                    <p class="text-sm text-gray-400">
                        Jl. Perpustakaan No. 123, Kota Buku
                        <br>
                        Email: info@perpusdigital.id | Telp: (021) 1234-5678
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
