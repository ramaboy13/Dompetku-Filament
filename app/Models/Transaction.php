<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Balance;

class Transaction extends Model
{
    protected $fillable = [
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
        //set user_id saat create
        static::creating(function ($transaction) {
            $transaction->user_id = Auth::id();
        });

        //update balance setelah create
        static::created(function ($transaction) {
            $transaction->updateBalance();
        });

        //rollback balance setelah delete
        static::deleted(function ($transaction) {
            $transaction->rollbackBalance();
        });
    }

    protected function updateBalance(): void
    {
        $balance = Balance::firstOrCreate(
            ['user_id' => $this->user_id],
            ['amount' => 0]
        );

        if ($this->category->pengeluaran) {
            $balance->decrement('amount', $this->amount);
        } else {
            $balance->increment('amount', $this->amount);
        }
    }

    protected function rollbackBalance(): void
    {
        $balance = Balance::where('user_id', $this->user_id)->first();

        if (! $balance) {
            return;
        }

        if ($this->category->pengeluaran) {
            $balance->increment('amount', $this->amount);
        } else {
            $balance->decrement('amount', $this->amount);
        }
    }

    public function scopePengeluaran($query)
    {
        return $query
            ->where('user_id', Auth::id())
            ->whereHas('category', fn ($q) => $q->where('pengeluaran', true));
    }

    public function scopePemasukan($query)
    {
        return $query
            ->where('user_id', Auth::id())
            ->whereHas('category', fn ($q) => $q->where('pengeluaran', false));
    }
}
