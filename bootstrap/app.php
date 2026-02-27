<?php

use App\Http\Middleware\EnsurePolicyAccepted;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\LocaleMiddleware;
use App\Http\Middleware\SecureHeaders;
use App\Http\Middleware\ShareCookieConsent;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

    )
    ->withMiddleware(function (Middleware $middleware) {
        //

        $middleware->trustProxies('*');
        $middleware->web(append: [
            LocaleMiddleware::class,
            ShareCookieConsent::class,
            EnsurePolicyAccepted::class,
            SecureHeaders::class,
        ]);
        $middleware->alias([
            'owner'=>\App\Http\Middleware\IsProfileOwner::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
