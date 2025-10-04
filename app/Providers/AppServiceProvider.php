<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermission;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot(): void
    {
             // Enabled https
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Default Password
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();
        });


        Route::aliasMiddleware('permission', CheckPermission::class);

        \App\Models\Tag::observe(\App\Observers\TagObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Post::observe(\App\Observers\PostObserver::class);
        \App\Models\Category::observe(\App\Observers\CategoryObserver::class);



        Gate::policy(\App\Models\Post::class, \App\Policies\Admin\PostPolicy::class);
        Gate::policy(\App\Models\Category::class,  \App\Policies\Admin\CategoryPolicy::class);
        Gate::policy(\App\Models\Tag::class,  \App\Policies\Admin\TagPolicy::class);
        Gate::policy(\App\Models\User::class,  \App\Policies\Admin\UserPolicy::class);
        Gate::policy(\App\Models\Role::class,  \App\Policies\Admin\RolePolicy::class);
        Gate::policy(\App\Models\Role::class,  \App\Policies\Admin\RolePolicy::class);
        Gate::policy(\App\Models\Contact::class,  \App\Policies\Admin\ContactPolicy::class);
        Gate::policy(\App\Models\Log::class,  \App\Policies\Admin\LogPolicy::class);
    }
}
