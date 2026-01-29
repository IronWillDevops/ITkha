<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Получить настройку: сначала из БД, иначе из .env
     */
    function setting(string $key, $default = null)
    {
        $value = Setting::get($key);
        return $value ?? env(strtoupper($key), $default);
    }
}
