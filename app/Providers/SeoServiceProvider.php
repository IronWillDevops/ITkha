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

            // Базовые настройки (fallback)
            $title = setting('site_name', config('app.name'));
            $description = setting('site_description', 'Default description');
            $image = asset('favicon.ico');
            $url = url()->current();

            $seo = SeoService::meta($title, $description, $image, $url);

            /**
             * -----------------------------------------------------------
             * SEO для страницы поста
             * -----------------------------------------------------------
             */
            if (
                Route::currentRouteName() === 'public.post.show'
                && $view->offsetExists('post')
            ) {
                $post = $view->getData()['post'];

                // Чистый текст без HTML
                $cleanContent = trim(
                    preg_replace('/\s+/', ' ', strip_tags($post->content))
                );
                $excerpt = mb_substr($cleanContent, 0, 150);

                $seo = SeoService::meta(
                    $post->title,
                    $excerpt,
                    $post->main_image
                        ? asset('storage/' . $post->main_image)
                        : asset('favicon.ico'),
                    $url
                );
            }

            /**
             * -----------------------------------------------------------
             * SEO для страницы пользователя
             * -----------------------------------------------------------
             */
            if (
                Route::currentRouteName() === 'public.user.show'
                && $view->offsetExists('user')
            ) {
                $user = $view->getData()['user'];
                $profile = $user->profile;

                $about = $profile?->about_myself;
                $job   = $profile?->job_title;

                // Чистый about
                $cleanAbout = $about
                    ? trim(preg_replace('/\s+/', ' ', strip_tags($about)))
                    : null;

                // Формирование description
                if ($job && $cleanAbout) {
                    $description = $job . '. ' . mb_substr($cleanAbout, 0, 150);
                } elseif ($job) {
                    $description = $job . ' — ' . setting('site_name', config('app.name'));
                } elseif ($cleanAbout) {
                    $description = mb_substr($cleanAbout, 0, 150);
                } else {
                    $description = "{$user->login} — " . setting('site_name', config('app.name'));
                }

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
