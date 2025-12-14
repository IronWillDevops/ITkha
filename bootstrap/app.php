<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\LocaleMiddleware;
use App\Http\Middleware\ShareCookieConsent;
use App\Http\Middleware\TrustProxies;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

    )
    ->withMiddleware(function (Middleware $middleware) {
        //

        $middleware->trustProxies(TrustProxies::class);
        $middleware->web(append: [
            LocaleMiddleware::class,
            ShareCookieConsent::class,
        ]);

        $middleware->alias([
            'policy.accepted' => App\Http\Middleware\EnsurePolicyAccepted::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
