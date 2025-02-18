<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Student\DashboardController as StudentController;
use App\Http\Controllers\Student\BorrowController as StudentBorrowController;
use App\Http\Controllers\Student\ReturnController as StudentReturnController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware; // Tambahkan middleware di sini

Route::get('/', function () {
    return view('welcome');
});

// Middleware Auth untuk semua pengguna yang login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('student.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Middleware khusus untuk Admin
// Middleware khusus untuk Admin
Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', BookController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('members', MemberController::class);
});


// Middleware khusus untuk Student (Tambahkan 'auth')
Route::prefix('student')->name('student.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::resource('borrows', StudentBorrowController::class);
    Route::resource('returns', StudentReturnController::class);
});

require __DIR__ . '/auth.php';
