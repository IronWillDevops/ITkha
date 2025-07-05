<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PublicRouteServiceProvider extends ServiceProvider
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

        RateLimiter::for('login', function (\Illuminate\Http\Request $request) {
            $email = strtolower($request->input('email', ''));
            return Limit::perMinute( 5,180)->by($email . '|' . $request->ip());
        });

        Route::domain(config('app.base_domain'))
            ->middleware('web')
            ->group(base_path('routes/public.php'));
    }
}
