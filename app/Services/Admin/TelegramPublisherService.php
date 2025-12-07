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
        $buttonText = setting('telegram_button_text', 'Read more...');
        $buttonText = $this->applyPlaceholders($buttonText, $post);


        // Формируем сообщение без htmlspecialchars, чтобы теги HTML работали
        $text = $this->applyPlaceholders(setting('telegram_template'), $post);


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

        $photoUrl = $post->main_image ? asset('storage/' . $post->main_image) : null;

        // Проверяем, что URL картинки доступен через HTTPS
        if ($photoUrl && str_starts_with($photoUrl, 'https://')) {
            // Ограничение caption ≤ 1024 символа
            $response = Http::post("https://api.telegram.org/bot{$token}/sendPhoto", [
                'chat_id' => $chatId,
                'photo' => $photoUrl,
                'caption' => Str::limit($text, 1024),
                'parse_mode' => 'HTML',
                'disable_notification' => setting('telegram_send_without_sound') == 1,
                'reply_markup' => json_encode($keyboard),
            ]);
        } else {
            // Отправка текста без фото
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

    private function applyPlaceholders(string $template, Post $post): string
    {
        $template = $this->normalizePlaceholders($template);

        $limit = setting('telegram_message_limit', 450);
        $excerpt = \Illuminate\Support\Str::limit(strip_tags($post->content), $limit);

        $tagsFormatted = $post->tags->isNotEmpty()
            ? $post->tags
            ->map(fn($t) => '#' . Str::slug($t->title))
            ->implode(' ')
            : null;

        $replacements = [
            '{{title}}'       => $post->title,
            '{{category}}'    => $post->category?->title ?? '',
            '{{tags}}'        => $tagsFormatted,
            '{{excerpt}}'     => $excerpt,
            '{{author}}'      => $post->author->login,
            '{{author_url}}'  => route('public.user.show', $post->author),
            '{{data}}'        => $post->created_at->format('d.m.Y H:i'),
            '{{url}}'         => route('public.post.show', $post->slug),
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $template);
    }

    private function normalizePlaceholders(string $template): string
    {
        return preg_replace('/\{\{\s*(.*?)\s*\}\}/', '{{$1}}', $template);
    }
}
