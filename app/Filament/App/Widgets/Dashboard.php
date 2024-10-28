<?php

namespace App\Filament\App\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseWidget
{
    protected function getStats(): array
    {
        // id shop
        $shopId = Auth::user()->shop_id;
        // Lấy số liệu hiện tại của shop
        $currentUsers = User::query()->where('shop_id',$shopId)->count();
        $currentProducts = Product::query()->where('shop_id',$shopId)->count();
        $currentOrders = Order::query()->where('shop_id',$shopId)->count();

        // Lấy số liệu của ngày hôm qua (hoặc khoảng thời gian khác) của shop
        $yesterdayUsers = User::query()->where('shop_id',$shopId)->whereDate('created_at', Carbon::yesterday())->count();
        $yesterdayProducts = Product::query()->where('shop_id',$shopId)->whereDate('created_at', Carbon::yesterday())->count();
        $yesterdayOrders = Order::query()->where('shop_id',$shopId)->whereDate('created_at', Carbon::yesterday())->count();

        // Tính toán sự thay đổi
        $usersChange = $currentUsers - $yesterdayUsers;
        $productsChange = $currentProducts - $yesterdayProducts;
        $ordersChange = $currentOrders - $yesterdayOrders;

        // Chọn icon và màu sắc dựa trên sự thay đổi
        $userIcon = $usersChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $userColor = $usersChange >= 0 ? 'success' : 'danger';

        $productIcon = $productsChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $productColor = $productsChange >= 0 ? 'success' : 'danger';

        $orderIcon = $ordersChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $orderColor = $ordersChange >= 0 ? 'success' : 'danger';

        return [
            Stat::make('Người dùng', $currentUsers)
                ->description('Tổng số người dùng')
                ->descriptionIcon($userIcon)
                ->color($userColor),

            Stat::make('Sản phẩm', $currentProducts)
                ->description('Tổng số sản phẩm')
                ->descriptionIcon($productIcon)
                ->color($productColor),

            Stat::make('Đơn hàng', $currentOrders)
                ->description('Tổng số đơn hàng')
                ->descriptionIcon($orderIcon)
                ->color($orderColor),
        ];
    }
}
