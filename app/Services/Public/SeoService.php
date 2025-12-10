<?php

namespace App\Services\Public;

use App\View\Components\Public\SeoMeta;

class SeoService
{
    public static function website(string $title, string $description, string $image, string $url): SeoMeta
    {
        return new SeoMeta('website', $title, $description, $image, $url);
    }

    public static function article($post, string $url): SeoMeta
    {
        $clean = trim(preg_replace('/\s+/', ' ', strip_tags($post->content)));
        $excerpt = mb_substr($clean, 0, 180);

        return new SeoMeta(
            'article',
            $post->title,
            $excerpt,
            $post->main_image ? asset('storage/' . $post->main_image) : asset('favicon.ico'),
            $url,
            [
                'article:published_time' => optional($post->created_at)->toIso8601String(),
                'article:modified_time'  => optional($post->updated_at)->toIso8601String(),
                'article:author'         => $post->author?->login,
                'article:tag'            => $post->tags?->pluck('title')->toArray() ?? [],
            ]
        );
    }

    public static function profile($user, string $url): SeoMeta
    {
        $profile = $user->profile;

        $first_name = $user?->first_name;
        $last_name  = $user?->last_name;

        return new SeoMeta(
            'profile',
            $user->login,
            $profile?->job_title ?: ($first_name . ' ' . $last_name),
            $user->avatar ? asset('storage/' . $user->avatar) : asset('favicon.ico'),
            $url,
            [
                'profile:first_name' => $first_name,
                'profile:last_name'  => $last_name,
                'profile:username'   => $user->login,
                'profile:gender'     => $profile?->gender,
            ]
        );
    }
}
