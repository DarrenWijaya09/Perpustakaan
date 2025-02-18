@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600">NIS: {{ Auth::user()->nis }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-green-50 p-6 rounded-lg">
            <div class="flex items-center">
                <div class="bg-green-600 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Buku Dipinjam</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $activeBorrowings }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 p-6 rounded-lg">
            <div class="flex items-center">
                <div class="bg-blue-600 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Peminjaman</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalBorrowings }}</p>
                </div>
            </div>
        </div>

        <div class="bg-purple-50 p-6 rounded-lg">
            <div class="flex items-center">
                <div class="bg-purple-600 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Buku Dikembalikan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $returnedBooks }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Riwayat Peminjaman Terakhir</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentTransactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->book->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->borrow_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                // Jika return_date belum ada, hitung dari borrow_date + 7 hari
                                $returnDate = $transaction->return_date
                                    ? $transaction->return_date->format('d M Y')
                                    : $transaction->borrow_date->copy()->addDays(7)->format('d M Y');
                            @endphp
                            {{ $returnDate }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $transaction->status === 'borrowed' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ $transaction->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Belum ada riwayat peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
