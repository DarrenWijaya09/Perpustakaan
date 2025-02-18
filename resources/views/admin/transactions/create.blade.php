@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">{{ isset($transaction) ? 'Edit Transaksi' : 'Tambah Transaksi Baru' }}</h2>

            <form
                action="{{ isset($transaction) ? route('admin.transactions.update', $transaction->id) : route('admin.transactions.store') }}"
                method="POST">
                @csrf
                @isset($transaction)
                    @method('PUT')
                @endisset

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Anggota -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Anggota</label>
                        <select name="user_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ (isset($transaction) && $transaction->user_id === $user->id) || old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->nis }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buku -->
                    <!-- Buku -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Buku</label>
                        <select name="book_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}"
                                    {{ (isset($transaction) && $transaction->book_id === $book->id) || old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} ({{ $book->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Tanggal Pinjam -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pinjam</label>
                        <input type="date" name="borrow_date"
                            value="{{ old('borrow_date', isset($transaction) ? $transaction->borrow_date->format('Y-m-d') : now()->format('Y-m-d')) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('borrow_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="statusSelect"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="borrowed"
                                {{ (isset($transaction) && $transaction->status === 'borrowed') || old('status') === 'borrowed' ? 'selected' : '' }}>
                                Dipinjam</option>
                            <option value="returned"
                                {{ (isset($transaction) && $transaction->status === 'returned') || old('status') === 'returned' ? 'selected' : '' }}>
                                Dikembalikan</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Kembali -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kembali</label>
                        <input type="date" name="return_date" id="returnDateInput"
                            value="{{ old('return_date', isset($transaction) && $transaction->return_date ? $transaction->return_date->format('Y-m-d') : '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            {{ (isset($transaction) && $transaction->status === 'borrowed') || old('status') === 'borrowed' ? 'disabled' : '' }}>
                        @error('return_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.transactions.index') }}"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-3">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript untuk mengaktifkan/menonaktifkan return_date -->
    <script>
        document.getElementById('statusSelect').addEventListener('change', function() {
            const returnDateInput = document.getElementById('returnDateInput');
            returnDateInput.disabled = this.value === 'borrowed';
        });
    </script>
@endsection
