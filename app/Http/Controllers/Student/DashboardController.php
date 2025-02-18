<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $activeBorrowings = Transaction::where('user_id', $user->id)->where('status', 'borrowed')->count();
        $totalBorrowings = Transaction::where('user_id', $user->id)->count();
        $returnedBooks = Transaction::where('user_id', $user->id)->where('status', 'returned')->count();

        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with('book')
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'activeBorrowings',
            'totalBorrowings',
            'returnedBooks',
            'recentTransactions'
        ));
    }
}
    