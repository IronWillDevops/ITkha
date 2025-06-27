<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminRouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
            Route::domain('admin.'. config('app.base_domain'))
                ->middleware(['web'])
                ->group(base_path('routes/admin.php'));
    }
}
