@extends('layouts.app')

@section('title', 'Peminjaman Buku')
@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Peminjaman Buku</h2>

    <!-- Search Form -->
    <div class="mb-6">
        <form action="{{ route('student.borrows.index') }}" method="GET">
            <div class="relative">
                <input type="text" name="search" placeholder="Cari buku..."
                       class="w-full pl-10 pr-4 py-2 rounded-lg border focus:outline-none focus:border-green-500"
                       value="{{ request('search') }}">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </form>
    </div>

    <!-- Books List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($books as $book)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $book->image) }}"
            alt="{{ $book->title }}"
            class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $book->title }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ $book->author }}</p>
                <p class="text-sm text-gray-600 mb-4">{{ $book->publisher }} ({{ $book->year }})</p>

                @php
                    $loanDate = now(); // Tanggal peminjaman (sekarang)
                    $returnDate = $loanDate->format('d M Y');
                @endphp

                <p class="text-sm text-gray-600">Tanggal Kembali: <strong>{{ $returnDate }}</strong></p>

                <div class="flex justify-between items-center">
                    <form action="{{ route('student.borrows.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg"
                                onclick="return confirm('Apakah Anda yakin ingin meminjam buku ini?')">
                            Pinjam
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-500">
            Tidak ada buku yang tersedia untuk dipinjam.
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $books->links() }}
    </div>
</div>
@endsection
