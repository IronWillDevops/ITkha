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

            // Дефолтные значения для всех страниц
            $title = setting('site_name', config('app.name'));
            $description = setting('site_description', 'Default description');
            $image = asset('favicon.ico');
            $url = url()->current();

            $seo = SeoService::meta($title, $description, $image, $url);

            // Динамический SEO для поста
            if (Route::currentRouteName() === 'public.post.show' && $view->offsetExists('post')) {
                $seo = SeoService::fromModel($view->getData()['post'], [
                    'title' => 'title',
                    'description' => 'content',
                    'image' => 'main_image',
                ]);
            }

            // Динамический SEO для пользователя
            if (Route::currentRouteName() === 'public.user.show' && $view->offsetExists('user')) {
                $seo = SeoService::fromModel($view->getData()['user'], [
                    'title' => 'login',
                    'description' => 'profile.about_myself',
                    'image' => 'avatar',
                ]);
            }

            // Передаём в view
            $view->with('seo', $seo);
        });
    }
}
