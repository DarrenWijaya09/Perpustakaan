<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['book_code', 'title', 'author', 'publisher', 'year', 'image'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('author', 'like', '%' . $filters['search'] . '%')
                ->orWhere('publisher', 'like', '%' . $filters['search'] . '%');
        }
    }
}
