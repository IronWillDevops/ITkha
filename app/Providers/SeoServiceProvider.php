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
            if (Route::currentRouteName() === 'public.user.show' && $view->offsetExists('user')) {

                $user = $view->getData()['user'];

                // Данные профиля
                $profile = $user->profile;
                $about  = $profile?->about_myself;
                $job    = $profile?->job_title;

              
                if ($job && $about) {
                    $description = $job . '. ' . mb_substr(strip_tags($about), 0, 150);
                } elseif ($job) {
                    $description = $job . ' — ' . setting('site_name', config('app.name'));
                } elseif ($about) {
                    $description = mb_substr(strip_tags($about), 0, 150);
                } else {
                    $description = "{$user->login} — " . setting('site_name', config('app.name'));
                }

                // Аватар или fallback
                $avatar = $user->avatar
                    ? asset('storage/' . $user->avatar)
                    : asset('favicon.ico');

                $seo = SeoService::meta(
                    $user->login,
                    $description,
                    $avatar,
                    $url
                );
            }



            $view->with('seo', $seo);
        });
    }
}
