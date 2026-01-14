<?php
// WidgetPemasukanChart.php
namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use App\Models\Transaction;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class WidgetPemasukanChart extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Pemasukan';
    protected static string $color = 'success';
    protected static ?int $sort = 3; // Urutan widget
    protected static ?int $columnSpanMd = 1;
    protected static ?int $columnSpanLg = 1;

    protected function getData(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null)
            ? Carbon::parse($this->filters['startDate'])
            : Carbon::now()->startOfMonth(); // Default ke awal bulan ini

        $endDate = !is_null($this->filters['endDate'] ?? null)
            ? Carbon::parse($this->filters['endDate'])
            : Carbon::now();

        $data = Trend::query(Transaction::query()->pemasukan())
            ->between(
                start: $startDate,
                end: $endDate,
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan Perhari',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'borderColor' => 'rgb(34, 197, 94)', // warna success
                    'fill' => false,
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => Carbon::parse($value->date)->format('d M')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
