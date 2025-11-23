<?php

namespace App\Services\Admin;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TelegramPublisherService
{
public function publish(Post $post): void
{
    if (!setting('telegram_enabled')) {
        return;
    }

    $token = setting('telegram_token');
    $chatId = setting('telegram_chat_id');
    $buttonText = setting('telegram_button_text', 'Читать подробнее');

    $text = htmlspecialchars($this->buildMessage($post), ENT_QUOTES | ENT_HTML5);
    $url  = route('public.post.show', $post->slug);

    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => $buttonText,
                    'url'  => $url,
                ]
            ]
        ]
    ];

    if ($post->main_image) {
        $photoUrl = asset('storage/' . $post->main_image);

        // Проверка, что URL начинается с https
        if (!str_starts_with($photoUrl, 'https://')) {
            logger()->warning("Telegram photo URL не HTTPS: {$photoUrl}");
            return;
        }

        $response = Http::post("https://api.telegram.org/bot{$token}/sendPhoto", [
            'chat_id' => $chatId,
            'photo' => $photoUrl,
            'caption' => $text,
            'parse_mode' => 'HTML',
            'disable_notification' => setting('telegram_send_without_sound') == 1,
            'reply_markup' => json_encode($keyboard),
        ]);
    } else {
        $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML',
            'disable_notification' => setting('telegram_send_without_sound') == 1,
            'reply_markup' => json_encode($keyboard),
        ]);
    }

    logger()->info('Telegram response', ['body' => $response->body()]);
}


    private function buildMessage(Post $post): string
    {
        $template = setting('telegram_template');

        $limit = setting('telegram_message_limit', 450);
        $excerpt = Str::limit(strip_tags($post->content), $limit);

        $replacements = [
            '{{ title }}'    => $post->title,
            '{{ category }}' => $post->category?->title ?? '',
            '{{ tags }}'     => $post->tags->pluck('title')->implode(', ') ?: '',
            '{{ excerpt }}'  => $excerpt,
            '{{ url }}'      => route('public.post.show', $post->slug),
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $template);
    }
}
