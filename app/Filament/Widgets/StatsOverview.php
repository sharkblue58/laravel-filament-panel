<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(__('message.total_users'), User::role('user')->count())
                ->description(__('message.user_stat_description'))
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make(__('message.total_orders'), Order::count())
                ->description(__('message.order_stat_description'))
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),

            Stat::make(__('message.total_products'), Product::count())
                ->description(__('message.product_stat_description'))
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),

        ];
    }
}
