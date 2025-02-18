<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['user_id', 'nis', 'class', 'major'];

    protected $table = 'members';

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
