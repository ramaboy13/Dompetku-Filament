<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()
                ->form([
                    Forms\Components\TextInput::make('month')
                        ->label('Bulan')
                        ->default(now()->format('m'))
                        ->required(),
                    Forms\Components\TextInput::make('year')
                        ->label('Tahun')
                        ->default(now()->format('Y'))
                        ->required(),
                ])
                ->action(function (array $data) {
                    $month = $data['month'];
                    $year = $data['year'];
                    return redirect()->route('download.test', [
                        'month' => $month,
                        'year' => $year,
                    ]);
                })
                ->color('primary')
                ->label('Export PDF')
                ->openUrlInNewTab(),
        ];
    }
}
