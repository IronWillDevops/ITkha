<?php

namespace  App\Services\Public\Language;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class LanguageService
{
    public function store($locale)
    {
        $available = array_values(config('app.available_locales'));

        if (!in_array($locale, $available)) {
            abort(404, __('message.error.invalid_language'));
        }

        Session::put('locale', $locale);
        Cookie::queue('locale', $locale, 60 * 24 * 30); // 30 днів
    }
}
