<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function getHeaderWidgetsColumns(): int|array
    {
        return [
            'md' => 3,
            'xl' => 4,
        ];
    }

    public function getColumns(): int|array
    {
        return [
            'sm' => 1,
            'md' => 2, // Ubah dari 3 ke 2 untuk layout lebih rapi
            'xl' => 3,
        ];
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\SaldoWidget::class,
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\WidgetPemasukanChart::class,
            \App\Filament\Widgets\WidgetPengeluaranChart::class,
        ];
    }

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Filter Tanggal')
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Dari Tanggal')
                            ->placeholder('Pilih tanggal awal')
                            ->maxDate(fn (Get $get) => $get('endDate') ?: now())
                            ->native(false),

                        DatePicker::make('endDate')
                            ->label('Sampai Tanggal')
                            ->placeholder('Pilih tanggal akhir')
                            ->minDate(fn (Get $get) => $get('startDate') ?: now())
                            ->maxDate(now())
                            ->native(false),
                    ])
                    ->columns(2) // Ubah dari 3 ke 2
                    ->collapsible()
                    ->compact(),
            ]);
    }
}