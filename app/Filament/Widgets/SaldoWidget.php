<?php

namespace App\Filament\Widgets;

use App\Models\Balance;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SaldoWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null; // Nonaktifkan auto-refresh
    
    protected static ?int $sort = 1; // Urutan widget

    protected function getStats(): array
    {
        $saldo = Balance::where('user_id', Auth::id())->value('amount') ?? 0;

        return [
            Stat::make('Saldo Saat Ini', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->description('Total saldo cash & bank')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color($saldo >= 0 ? 'success' : 'danger')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }

    public static function canView(): bool
    {
        return true;
    }
}