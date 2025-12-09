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

            // Дефолтные значения
            $title = setting('site_name', config('app.name'));
            $description = setting('site_description', 'Default description');
            $image = asset('favicon.ico');
            $url = url()->current();

            // Создаём дефолтный SEO массив
            $seo = SeoService::meta($title, $description, $image, $url);

            // Если это страница поста и передан $post
            if (Route::currentRouteName() === 'public.post.show' && $view->offsetExists('post')) {
                $post = $view->getData()['post'];
                $seo = SeoService::meta(
                    $post->title,
                    $post->content ?? substr(strip_tags($post->content), 0, 150),
                    isset($post->main_image) ? asset('storage/' . $post->main_image) : "",
                    $url
                );
            }

            $view->with('seo', $seo);
        });
    }
}
