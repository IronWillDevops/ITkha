<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        \App\Events\PostPublished::class => [
            \App\Listeners\SendPostToTelegram::class,
        ],
    ];

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }

    public function boot(): void
    {
    
    }
}
