<?php

if (!function_exists('highlight')) {
    function highlight(string $text, ?string $keyword): string
    {
        if (!$keyword) {
            return e($text);
        }

        $escapedKeyword = preg_quote($keyword, '/');

        // Підсвічує всі входження <mark>
        $highlighted = preg_replace(
            "/($escapedKeyword)/iu",
            '<mark>$1</mark>',
            e($text) // захист від XSS
        );

        return $highlighted ?? e($text); // fallback якщо щось пішло не так
    }
}
