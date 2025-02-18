<!-- resources/views/admin/books/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">{{ isset($book) ? 'Edit Buku' : 'Tambah Buku Baru' }}</h2>

        <form action="{{ isset($book) ? route('admin.books.update', $book->id) : route('admin.books.store') }}"
            method="POST" enctype="multipart/form-data">
          @csrf
          @isset($book) @method('PUT') @endisset

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Kode Buku -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Kode Buku</label>
                  <input type="text" name="book_code" value="{{ old('book_code', $book->book_code ?? '') }}"
                         class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                  @error('book_code')
                      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Judul Buku -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Judul Buku</label>
                  <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}"
                         class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                  @error('title')
                      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Pengarang -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Pengarang</label>
                  <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}"
                         class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                  @error('author')
                      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Penerbit -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Penerbit</label>
                  <input type="text" name="publisher" value="{{ old('publisher', $book->publisher ?? '') }}"
                         class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                  @error('publisher')
                      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Tahun Terbit -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Terbit</label>
                  <input type="number" name="year" value="{{ old('year', $book->year ?? '') }}"
                         class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                  @error('year')
                      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Unggah Gambar -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Buku</label>
                  <input type="file" name="image" accept="image/*"
                         class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                  @error('image')
                      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror

                  <!-- Preview Gambar Jika Ada -->
                  @if(isset($book) && $book->image)
                      <div class="mt-3">
                          <p class="text-sm text-gray-600">Gambar saat ini:</p>
                          <img src="{{ asset('storage/' . $book->image) }}" class="h-40 rounded-md mt-2">
                      </div>
                  @endif
              </div>
          </div>

          <div class="mt-6 flex justify-end">
              <a href="{{ route('admin.books.index') }}"
                 class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-3">
                  Batal
              </a>
              <button type="submit"
                      class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                  </svg>
                  Simpan
              </button>
          </div>
      </form>

    </div>
</div>
@endsection
