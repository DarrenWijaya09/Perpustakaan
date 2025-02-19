<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransactionRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function borrow(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $book = Book::findOrFail($request->book_id);

        // Cek apakah buku sedang dipinjam
        if ($book->status === 'borrowed') {
            return back()->withErrors(['book_id' => 'Buku ini sedang dipinjam dan belum tersedia.']);
        }

        // Simpan transaksi peminjaman
        Transaction::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id,
            'borrow_date' => now(),
            'return_date' => null,
            'status' => 'borrowed'
        ]);

        return redirect()->route('transactions.index')->with('success', 'Buku berhasil dipinjam!');
    }

    public function returnBook($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->return_date) {
            return back()->withErrors(['return_date' => 'Buku sudah dikembalikan sebelumnya.']);
        }

        // Update status transaksi dan ubah status buku
        $transaction->update([
            'return_date' => now(),
            'status' => 'returned'
        ]);

        return redirect()->route('transactions.index')->with('success', 'Buku berhasil dikembalikan!');
    }

    public function index()
    {
        $transactions = Transaction::when(request('search'), function ($query) {
                return $query->where('status', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::where('role', 'student')->get();

        // Ambil buku yang tidak sedang dipinjam
        $books = Book::whereDoesntHave('transactions', function ($query) {
            $query->where('status', 'borrowed');
        })->get();

        return view('admin.transactions.create', compact('users', 'books'));
    }


    public function store(TransactionRequest $request)
    {
        $data = $request->validated();
        Transaction::create($data);
        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit(Transaction $transaction)
    {
        $users = User::where('role', 'student')->get();
        $books = Book::all();

        return view('admin.transactions.create', compact('transaction', 'users', 'books'));
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->validated();

        // Hanya update field yang diperbolehkan
        unset($data['user_id']); // Hindari perubahan user_id

        // Handle return date
        if($data['status'] === 'returned' && is_null($transaction->return_date)) {
            $data['return_date'] = now();
        }

        $transaction->update($data);
        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }


    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return back()->with('success', 'Transaksi berhasil dihapus!');
    }
}
