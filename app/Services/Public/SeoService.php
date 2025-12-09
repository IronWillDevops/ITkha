<?php

namespace App\Services\Public;

use Illuminate\Support\Facades\URL;

use Illuminate\Database\Eloquent\Model;
class SeoService
{
    public static function meta($title, $description = '', $image = '', string $url = ''): array
    {
        return [
            'title' => $title,
            'description' => $description ?: config('app.name'),
            'image' => $image,
            'url' => $url ?: url()->current(),
        ];
    }
    public static function fromModel(Model $model, array $fields = []): array
    {
        $titleField = $fields['title'] ?? 'title';
        $descField  = $fields['description'] ?? 'content';
        $imageField = $fields['image'] ?? 'main_image';

        $title = $model->{$titleField} ?? (method_exists($model, 'name') ? $model->name : config('app.name'));
        $description = $model->{$descField} ?? (method_exists($model, 'description') ? $model->description : '');
        $image = isset($model->{$imageField}) ? asset('storage/' . $model->{$imageField}) : asset('default-image.png');

        return self::meta($title, $description, $image);
    }
}
