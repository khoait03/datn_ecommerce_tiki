<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Product;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;

class ProductChart extends ChartWidget
{
    protected static ?string $heading = 'Sản phẩm';

    protected function getData(): array
    {
        $shopId = Auth::user()->shop_id;

        $data = Trend::query(
            Product::query()->where('shop_id',$shopId) // lấy sản phẩm trong shop
        )
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Sản phẩm ra mắt',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
