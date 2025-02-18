<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100" x-data="{ isMobileMenuOpen: false, isProfileMenuOpen: false }">
    <aside class="hidden md:flex md:flex-col fixed inset-y-0 left-0 w-64 bg-gray-800 border-r border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700">
            <h1 class="text-xl font-bold text-white">
                <span class="text-blue-400">Lib</span>Manager
            </h1>
            <p class="text-sm text-gray-400 mt-1">Admin Dashboard</p>
        </div>
        <nav class="flex-1 px-4 py-6">
            <ul class="space-y-2">
                <li><a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.books.index') }}" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.books.*') ? 'bg-gray-700' : '' }}">Kelola Buku</a></li>
                <li><a href="{{ route('admin.members.index') }}" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.members.*') ? 'bg-gray-700' : '' }}">Kelola Anggota</a></li>
                <li><a href="{{ route('admin.transactions.index') }}" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.transactions.*') ? 'bg-gray-700' : '' }}">Transaksi</a></li>
            </ul>
        </nav>
        <div class="px-4 py-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full p-2 text-red-400 hover:bg-gray-700 rounded-lg">Logout</button>
            </form>
        </div>
    </aside>
    <div class="md:ml-64">
        <header class="md:hidden fixed w-full bg-white shadow-sm z-10">
            <div class="flex items-center justify-between px-4 py-3">
                <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-gray-600 hover:text-gray-800">☰</button>
                <div class="text-lg font-bold text-gray-800">{{ config('app.name') }}</div>
            </div>
        </header>
        <div class="md:hidden fixed inset-0 z-20 bg-gray-800 bg-opacity-75" x-show="isMobileMenuOpen" @click.away="isMobileMenuOpen = false">
            <div class="w-64 bg-gray-800 h-full p-4">
                <nav class="mt-8">
                    <ul class="space-y-4">
                        <li><a href="{{ route('admin.dashboard') }}" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Dashboard</a></li>
                        <li><a href="{{ route('admin.books.index') }}" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Kelola Buku</a></li>
                        <li><a href="{{ route('admin.members.index') }}" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Kelola Anggota</a></li>
                        <li><a href="{{ route('admin.transactions.index') }}" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Transaksi</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full p-2 text-left text-red-400 hover:bg-gray-700 rounded">Logout</button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <main class="min-h-screen pt-16 md:pt-0">
            <div class="p-6">@yield('content')</div>
        </main>
    </div>
</body>
</html>
