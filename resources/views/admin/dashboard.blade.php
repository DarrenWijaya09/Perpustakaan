<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Total Buku</h3>
                <p class="text-3xl">{{ $stats['total_books'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Total Anggota</h3>
                <p class="text-3xl">{{ $stats['total_members'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Peminjaman Aktif</h3>
                <p class="text-3xl">{{ $stats['active_loans'] }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <a href="{{ route('admin.books.create') }}"
                class="bg-blue-500 text-white p-4 rounded-lg text-center hover:bg-blue-600">
                Tambah Buku Baru
            </a>
            <a href="{{ route('admin.members.index') }}"
                class="bg-green-500 text-white p-4 rounded-lg text-center hover:bg-green-600">
                Kelola Anggota
            </a>
            <a href="{{ route('admin.transactions.index') }}"
                class="bg-purple-500 text-white p-4 rounded-lg text-center hover:bg-purple-600">
                Lihat Transaksi
            </a>
        </div>
    </div>
@endsection
