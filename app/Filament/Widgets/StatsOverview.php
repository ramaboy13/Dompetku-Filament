<?php

namespace App\Filament\Widgets;

use App\Models\transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pengeluaran = transaction::pemasukan()->get()->sum('amount');
        $pemasukan = transaction::pengeluaran()->get()->sum('amount');
        return [
            Stat::make('Pemasukan', $pemasukan),
            Stat::make('Pengeluaran', $pengeluaran),
            Stat::make('Total', $pemasukan - $pengeluaran),
        ];
    }
}
