<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'amount',
        'description',
        'image',
        'date_transaction',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'transaction_tag')->withTimestamps();
    }

    protected static function booted()
    {
        static::saving(function ($transaction) {
            $transaction->user_id = Auth::id();
        });
    }

    public function scopePengeluaran($query)
    {
        return $query
            ->where('user_id', Auth::id())
            ->whereHas('category', function ($query) {
                $query->where('pengeluaran', true);
            });
    }

    public function scopePemasukan($query)
    {
        return $query
            ->where('user_id', Auth::id())
            ->whereHas('category', function ($query) {
                $query->where('pengeluaran', false);
            });
    }
}
