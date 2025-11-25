<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Spatie\Permission\Models\Role;

class RoleDistributionChart extends ChartWidget
{

    protected static ?int $sort = 5;

    public function getHeading(): string
    {
        return __('message.role_distribution_chart');
    }

       public static function canView(): bool
    {
        return auth()->user()?->hasRole('super admin') ?? false;
    }

    protected function getData(): array
    {
        $roles = Role::pluck('name');
        $roleCount = $roles->count();
        $counts = $roles->map(fn($roleName) => User::role($roleName)->count());
        $backgroundColor = $roles->map(function ($roleName, $index) use ($roleCount) {
            $hue = ($index * 360 / $roleCount);
            return "hsl($hue, 70%, 50%)";
        });

        return [
            'labels' => $roles->toArray(),
            'datasets' => [
                [
                    'label' => 'Users by Role',
                    'data' => $counts->toArray(),
                    'backgroundColor' => $backgroundColor->toArray(),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
