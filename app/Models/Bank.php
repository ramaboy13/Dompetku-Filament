<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'bank',
        'norek',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
