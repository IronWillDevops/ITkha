<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Получить настройку: сначала из БД, иначе из .env
     */
    function setting(string $key, $default = null)
    {
        // если в БД есть значение — берем его
        $value = Setting::get($key);

        // если нет, берем из .env или переданное значение по умолчанию
        return $value ?? env(strtoupper($key), $default);
    }
}
