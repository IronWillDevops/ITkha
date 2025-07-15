<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     protected array $availableLocales = ['en', 'uk'];

    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale') // якщо мова вже в сесії
            ?? Cookie::get('locale')     // або з cookie
            ?? $this->getBrowserLocale($request) // або автоматично
            ?? config('app.locale');     // або fallback

        if (in_array($locale, $this->availableLocales)) {
            App::setLocale($locale);
        }

        // зберігаємо в сесію і куку для наступних запитів
        Session::put('locale', $locale);
        Cookie::queue('locale', $locale, 60 * 24 * 30); // 30 днів

        return $next($request);
    }

    protected function getBrowserLocale(Request $request): ?string
    {
        $lang = substr($request->server('HTTP_ACCEPT_LANGUAGE') ?? '', 0, 2);
        return in_array($lang, $this->availableLocales) ? $lang : null;
    }
}
