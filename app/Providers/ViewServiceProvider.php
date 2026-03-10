<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('public.partials.sidebar', function ($view) {

            $categories = Cache::remember(
                'sidebar.categories',
                now()->addHour(),
                fn() => Category::query()
                    ->has('posts')
                    ->limit(5)
                    ->withCount('posts')
                    ->orderBy('title')
                    ->get()
            );

            $tags = Cache::remember(
                'sidebar.tags',
                now()->addHour(),
                fn() => Tag::query()
                    ->has('posts')
                    ->withCount('posts')
                    ->orderByDesc('posts_count')
                    ->limit(10)
                    ->get()
            );

            $view->with([
                'categories' => $categories,
                'tags' => $tags,
            ]);
        });
    }
}
