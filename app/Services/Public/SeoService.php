<?php

namespace App\Services\Public;

use Illuminate\Support\Facades\URL;

class SeoService
{
    public static function meta($title, $description = '', $image = '',string $url = ''): array
    {return [
            'title' => $title,
            'description' => $description ?: config('app.name'),
            'image' => $image ,
            'url' => $url ?: url()->current(),
        ];
    }
}
