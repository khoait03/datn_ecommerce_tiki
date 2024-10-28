<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;

class OrderChart extends ChartWidget
{
    protected static ?string $heading = 'Đơn hàng';

    protected function getData(): array
    {
        $shopId = Auth::user()->shop_id;
        $data = Trend::query(
            Order::query()->where('shop_id', $shopId) // lấy đơn hàng của shop
        )
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        // Lấy dữ liệu của tháng hiện tại và tháng trước đó
        $currentMonthData = $data->last();
        // Lấy dữ liệu của tháng trước đó
        // -2: Offset âm giúp bạn lấy các phần tử từ cuối Collection. Với -2, bạn đang yêu cầu phần tử thứ hai từ cuối cùng. Đây thường là dữ liệu của tháng trước đó khi bạn đã sắp xếp dữ liệu từ đầu năm tới hiện tại.
        // 1: Bạn chỉ cần một phần tử, đó là dữ liệu của tháng trước.
        $previousMonthData = $data->slice(-2, 1)->first();

        // Tính toán phần trăm thay đổi
        $percentageChange = 0;
        if ($previousMonthData && $currentMonthData) {
            $previousCount = $previousMonthData->aggregate;
            $currentCount = $currentMonthData->aggregate;

            if ($previousCount > 0) {
                $percentageChange = (($currentCount - $previousCount) / $previousCount) * 100;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Đơn hàng',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
            'percentageChange' => number_format($percentageChange, 2) . '%', // Thêm phần trăm thay đổi
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
