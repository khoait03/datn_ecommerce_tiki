<?php

namespace App\Filament\App\Resources\OrderResource\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Filament\App\Resources\OrderResource\Pages\ListOrders;
use App\Models\Order;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;

class OrderStatus extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListOrders::class;
    }

    protected function getStats(): array
    {
        $shopId = Auth::user()->shop_id;

        // Dữ liệu xu hướng trong năm qua, chỉ tính đơn hàng đã thanh toán
        $orderData = Trend::query(
            Order::query()
                ->where('shop_id', $shopId) // Lọc theo shop_id
                ->where('is_paid', 1) // Chỉ tính đơn hàng đã thanh toán
        )
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth() // Sử dụng perMonth để hiển thị dữ liệu theo tháng
            ->count();

        // Tính toán số lượng đơn hàng và doanh thu hàng ngày và hàng tuần
        $dailyOrdersCount = Order::whereDate('created_at', today())
            ->where('shop_id', $shopId)
            ->where('is_paid', 1) // Chỉ tính đơn hàng đã thanh toán
            ->count();

        $weeklyOrdersCount = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('shop_id', $shopId)
            ->where('is_paid', 1) // Chỉ tính đơn hàng đã thanh toán
            ->count();

        $dailyRevenue = Order::whereDate('created_at', today())
            ->where('shop_id', $shopId)
            ->where('is_paid', 1) // Chỉ tính doanh thu từ đơn hàng đã thanh toán
            ->sum('total_price');

        $weeklyRevenue = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('shop_id', $shopId)
            ->where('is_paid', 1) // Chỉ tính doanh thu từ đơn hàng đã thanh toán
            ->sum('total_price');

        return [
            Stat::make('Đơn hàng đã thanh toán trong ngày', $dailyOrdersCount)
                ->chart(
                    $orderData
                        ->map(fn(TrendValue $value) => $value->aggregate)
                        ->toArray()
                ),

            Stat::make('Đơn hàng đã thanh toán trong tuần', $weeklyOrdersCount)
                ->chart(
                    $orderData
                        ->map(fn(TrendValue $value) => $value->aggregate)
                        ->toArray()
                ),

            Stat::make('Doanh thu từ đơn hàng đã thanh toán trong ngày', number_format($dailyRevenue, 0, ',', '.').' VND'),

            Stat::make('Doanh thu từ đơn hàng đã thanh toán trong tuần', number_format($weeklyRevenue, 0, ',', '.').' VND'),
        ];
    }

}
