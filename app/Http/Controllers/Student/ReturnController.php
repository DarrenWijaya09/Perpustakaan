<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Mengambil transaksi dengan status 'borrowed' untuk user yang login
        $transactions = Transaction::where('user_id', $user->id)
            ->where('status', 'borrowed') // Hanya tampilkan transaksi yang statusnya 'borrowed'
            ->with('book')
            ->orderByDesc('borrow_date')
            ->paginate(10);

        return view('student.return.index', compact('transactions'));
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
        //
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
    public function update(Request $request, $id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Validasi apakah buku sudah dikembalikan
        if ($transaction->status === 'Dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }

        // Update transaksi dengan status 'Dikembalikan'
        $transaction->status = 'returned';
        $transaction->return_date = now(); // Tanggal pengembalian buku
        $transaction->save(); // Simpan perubahan

        return redirect()->route('student.returns.index')
            ->with('success', 'Buku berhasil dikembalikan!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
