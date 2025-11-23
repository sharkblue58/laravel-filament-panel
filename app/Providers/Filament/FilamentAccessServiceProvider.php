<?php

namespace App\Providers\Filament;

use Illuminate\Support\ServiceProvider;

class FilamentAccessServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    public function boot(): void
    {
        /*         Filament::serving(function () {
            if (!auth()->check() || !auth()->user()->hasAnyRole(['admin', 'super admin'])) {
                abort(403, 'Access denied');
            }
        }); */
    }
}
