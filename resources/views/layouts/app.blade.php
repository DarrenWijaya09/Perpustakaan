<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50" x-data="{ isMobileMenuOpen: false }">
        <!-- Navbar -->
        <nav class="bg-green-600 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-white text-xl font-bold">Perpustakaan Digital</span>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                        <a href="{{ route('student.dashboard') }}"
                           class="text-white hover:bg-green-700 px-3 py-2 rounded-md">Dashboard</a>
                        <a href="{{ route('student.borrows.index') }}"
                           class="text-white hover:bg-green-700 px-3 py-2 rounded-md">Peminjaman</a>
                           <a href="{{ route('student.returns.index') }}"
                           class="text-white hover:bg-green-700 px-3 py-2 rounded-md">Pengembalian</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white hover:bg-green-700 px-3 py-2 rounded-md">
                                Logout
                            </button>
                        </form>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="sm:hidden flex items-center">
                        <button @click="isMobileMenuOpen = !isMobileMenuOpen"
                                class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-green-700">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': isMobileMenuOpen, 'inline-flex': !isMobileMenuOpen}"
                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !isMobileMenuOpen, 'inline-flex': isMobileMenuOpen}"
                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="sm:hidden" x-show="isMobileMenuOpen" @click.away="isMobileMenuOpen = false">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('student.dashboard') }}"
                       class="text-white block px-3 py-2 rounded-md hover:bg-green-700">Dashboard</a>
                    <a href=""
                       class="text-white block px-3 py-2 rounded-md hover:bg-green-700">Peminjaman</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white block px-3 py-2 rounded-md hover:bg-green-700 w-full text-left">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </body>
</html>
