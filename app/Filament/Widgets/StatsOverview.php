<?php
namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Transaction;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?string $pollingInterval = null;
    protected static ?int $sort = 2; // Urutan setelah SaldoWidget

    protected function getStats(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null)
            ? Carbon::parse($this->filters['startDate'])
            : Carbon::now()->startOfMonth();

        $endDate = !is_null($this->filters['endDate'] ?? null)
            ? Carbon::parse($this->filters['endDate'])
            : Carbon::now();

        $pemasukan = Transaction::pemasukan()
            ->whereBetween('date_transaction', [$startDate, $endDate])
            ->sum('amount');

        $pengeluaran = Transaction::pengeluaran()
            ->whereBetween('date_transaction', [$startDate, $endDate])
            ->sum('amount');

        $selisih = $pemasukan - $pengeluaran;

        return [
            Stat::make('Pemasukan', 'Rp ' . number_format($pemasukan, 0, ',', '.'))
                ->description('Total pemasukan periode')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Pengeluaran', 'Rp ' . number_format($pengeluaran, 0, ',', '.'))
                ->description('Total pengeluaran periode')
                ->descriptionIcon('heroicon-o-arrow-trending-down')
                ->color('danger')
                ->chart([17, 4, 15, 3, 10, 2, 7]),

            Stat::make('Selisih', 'Rp ' . number_format($selisih, 0, ',', '.'))
                ->description('Pemasukan - Pengeluaran')
                ->descriptionIcon('heroicon-o-scale')
                ->color($selisih >= 0 ? 'success' : 'danger')
                ->chart([$selisih > 0 ? 1 : -1]),
        ];
    }

    public static function canView(): bool
    {
        return true;
    }
}