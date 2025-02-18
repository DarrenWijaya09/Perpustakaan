<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'book_id', 'borrow_date', 'return_date', 'status'];

    protected $table = 'transactions';

    protected $casts = [
        'borrow_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Ubah status buku saat transaksi dibuat (borrowed) dan saat dikembalikan (returned)
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->book->update(['status' => 'borrowed']);
        });

        static::updating(function ($transaction) {
            if ($transaction->return_date) {
                $transaction->book->update(['status' => 'returned']);
            }
        });
    }


}
