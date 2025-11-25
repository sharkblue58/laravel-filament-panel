<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    public static function canView(): bool
    {
        return auth()->user()?->hasRole('super admin') ?? false;
    }
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
