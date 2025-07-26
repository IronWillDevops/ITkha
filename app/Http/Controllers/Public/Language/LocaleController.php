<?php

namespace App\Http\Controllers\Public\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     */
      public function __invoke(string $locale)
    {
        $available = array_values(config('app.available_locales'));

        if (!in_array($locale, $available)) {
            abort(400, __('message.error.invalid_language'));
        }

        Session::put('locale', $locale);
        Cookie::queue('locale', $locale, 60 * 24 * 30); // 30 днів

        return redirect()->back();
    }
}
