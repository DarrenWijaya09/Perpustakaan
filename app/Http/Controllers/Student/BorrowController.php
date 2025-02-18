<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Student\BorrowRequest;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya menampilkan buku yang belum dipinjam (tidak ada transaksi "borrowed")
        $books = Book::whereDoesntHave('transactions', function ($query) {
            $query->where('status', 'borrowed');
        })->filter(request(['search']))->latest()->paginate(10);

        return view('student.borrow.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $book = Book::findOrFail($request->book_id);

        // Cek apakah buku sedang dipinjam berdasarkan transaksi terakhir
        $isBorrowed = Transaction::where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->exists();

        if ($isBorrowed) {
            return back()->withErrors(['book_id' => 'Buku ini sedang dipinjam dan belum tersedia.']);
        }

        // Simpan data peminjaman
        Transaction::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'borrow_date' => now(),
            'return_date' => null, // Akan diisi saat buku dikembalikan
            'status' => 'borrowed'
        ]);

        return redirect()->route('student.borrows.index')->with('success', 'Buku berhasil dipinjam!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
