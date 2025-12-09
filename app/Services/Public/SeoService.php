<?php

namespace App\Services\Public;


class SeoService
{
    public static function meta($title, $description = '', $image = '', string $url = ''): array
    {
        return [
            'title' => $title,
            'description' => $description ?: setting('site_description'),
            'image' => $image,
            'url' => $url ?: url()->current(),
        ];
    }
    
}
