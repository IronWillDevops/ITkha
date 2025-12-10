<?php

namespace App\Providers;

use App\Services\Public\SeoService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Route;

class SeoServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {

            $url = url()->current();

            // fallback: website
            $seo = SeoService::website(
                setting('site_name', config('app.name')),
                setting('site_description', 'Default description'),
                asset('favicon.ico'),
                $url
            );

            // Пост
            if (
                Route::currentRouteName() === 'public.post.show'
                && $view->offsetExists('post')
            ) {
                $seo = SeoService::article($view->getData()['post'], $url);
            }

            // Пользователь
            if (
                Route::currentRouteName() === 'public.user.show'
                && $view->offsetExists('user')
            ) {
                $seo = SeoService::profile($view->getData()['user'], $url);
            }

            $view->with('seo', $seo->toArray());
        });
    }
}
