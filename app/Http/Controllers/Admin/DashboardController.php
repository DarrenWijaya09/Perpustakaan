<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_members' => User::where('role', 'student')->count(),
            'active_loans' => Transaction::where(function ($query) {
                $query->whereNull('return_date')
                    ->orWhere('return_date', '');
            })->count()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
