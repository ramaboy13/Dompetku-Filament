<?php

namespace App\Filament\Widgets;
use Carbon\Carbon;
use App\Models\transaction;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected function getStats(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();
        $pemasukan = transaction::pemasukan()->get()->whereBetween('date_transaction', [$startDate, $endDate])->sum('amount');
        $pengeluaran = transaction::pengeluaran()->get()->whereBetween('date_transaction', [$startDate, $endDate])->sum('amount');
        return [
            Stat::make('Pemasukan', $pemasukan),
            Stat::make('Pengeluaran', $pengeluaran),
            Stat::make('Total', $pemasukan - $pengeluaran),
        ];
    }
}
