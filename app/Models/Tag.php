<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function transactions()
    {
        return $this->belongsToMany(transaction::class, 'transaction_tag')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
