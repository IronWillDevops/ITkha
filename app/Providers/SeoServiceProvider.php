<?php

namespace App\Providers;

use App\Models\Setting;
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
            static $seoCache = null; // вычисляется один раз за запрос

            if ($seoCache === null) {
                $url = url()->current();
                $settings = Setting::allSettings(); // один вызов

                $seoCache = SeoService::website(
                    $settings['site_name'] ?? config('app.name'),
                    $settings['site_description'] ?? 'Default description',
                    asset('favicon.ico'),
                    $url
                )->toArray();
            }

            $seo = $seoCache;

            // Пост — переопределяем если нужно
            if (
                Route::currentRouteName() === 'public.post.show'
                && $view->offsetExists('post')
            ) {
                $seo = SeoService::article($view->getData()['post'], url()->current())->toArray();
            }

            // Пользователь
            if (
                Route::currentRouteName() === 'public.user.show'
                && $view->offsetExists('user')
            ) {
                $seo = SeoService::profile($view->getData()['user'], url()->current())->toArray();
            }

            $view->with('seo', $seo);
        });
    }
}
