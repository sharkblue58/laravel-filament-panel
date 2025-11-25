<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductsCreatedChart extends ChartWidget
{
    protected static ?int $sort = 4;

    public function getHeading(): string
    {
        return __('message.products_created_chart');
    }

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('super admin') ?? false;
    }

    protected function getData(): array
    {
        $year = now()->year;

        //  get counts per month
        $monthlyCounts = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month'); // key = month, value = count

        // Fill months with 0 if no products in that month
        $months = collect(range(1, 12));
        $counts = $months->map(fn($m) => $monthlyCounts->get($m, 0))->toArray();

        // Labels
        $labels = $months->map(fn($m) => Carbon::createFromDate($year, $m, 1)->format('M'))->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Products Created',
                    'data' => $counts,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
