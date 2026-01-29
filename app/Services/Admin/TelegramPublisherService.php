<?php

namespace App\Services\Admin;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TelegramPublisherService
{
    private const MAX_CAPTION_LENGTH = 1024;
    private const DEFAULT_MESSAGE_LIMIT = 450;
    private const DEFAULT_BUTTON_TEXT = 'Read more...';

    public function publish(Post $post): bool
    {
        if (!$this->isEnabled()) {
            return false;
        }

        $response = $this->hasValidPhoto($post)
            ? $this->sendPhoto($post)
            : $this->sendMessage($post);

        $this->logResponse($response);

        return $response->successful();
    }

    private function isEnabled(): bool
    {
        return (bool) setting('telegram_enabled');
    }

    private function hasValidPhoto(Post $post): bool
    {
        $media = $post->singleMedia('main_image');

        return $media && str_starts_with($media->url, 'https://');
    }

    private function sendPhoto(Post $post)
    {
        $text = $this->buildMessage($post);

        return Http::post($this->getApiUrl('sendPhoto'), [
            'chat_id' => $this->getChatId(),
            'photo' => $post->singleMedia('main_image')->url,
            'caption' => Str::limit($text, self::MAX_CAPTION_LENGTH),
            'parse_mode' => 'HTML',
            'disable_notification' => $this->isSilentMode(),
            'reply_markup' => $this->buildKeyboard($post),
        ]);
    }

    private function sendMessage(Post $post)
    {
        $payload = [
            'chat_id' => $this->getChatId(),
            'text' => $this->buildMessage($post),
            'parse_mode' => 'HTML',
            'disable_notification' => $this->isSilentMode(),
            'reply_markup' => $this->buildKeyboard($post),
        ];

        return Http::post($this->getApiUrl('sendMessage'), $payload);
    }

    private function buildMessage(Post $post): string
    {
        $template = setting('telegram_template');

        return $this->applyPlaceholders($template, $post);
    }

    private function buildKeyboard(Post $post): string
    {
        $buttonText = $this->applyPlaceholders(
            setting('telegram_button_text', self::DEFAULT_BUTTON_TEXT),
            $post
        );

        return json_encode([
            'inline_keyboard' => [[
                [
                    'text' => $buttonText,
                    'url' => route('public.post.show', $post->slug),
                ]
            ]]
        ]);
    }

    private function applyPlaceholders(string $template, Post $post): string
    {
        $template = $this->normalizePlaceholders($template);

        $replacements = $this->buildReplacements($post);

        // Удаляем плейсхолдер тегов, если их нет
        if ($post->tags->isEmpty()) {
            $template = preg_replace('/\{\{tags\}\}\r?\n?/', '', $template);
        }

        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            $template
        );
    }

    private function buildReplacements(Post $post): array
    {
        return [
            '{{title}}' => $post->title,
            '{{category}}' => $post->category?->title ?? '',
            '{{excerpt}}' => $this->buildExcerpt($post),
            '{{author}}' => $post->author->login,
            '{{author_url}}' => route('public.user.show', $post->author),
            '{{data}}' => $post->created_at->format('d.m.Y H:i'),
            '{{url}}' => route('public.post.show', $post->slug),
            '{{tags}}' => $this->buildTags($post),
        ];
    }

    private function buildExcerpt(Post $post): string
    {
        $limit = setting('telegram_message_limit', self::DEFAULT_MESSAGE_LIMIT);

        $html = $this->prepareHtmlForTelegram($post->content);
        $text = strip_tags($html);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = $this->normalizeContentText($text);

        return Str::limit($text, $limit);
    }

    private function buildTags(Post $post): string
    {
        return $post->tags
            ->map(fn($tag) => '#' . Str::slug($tag->title))
            ->implode(' ');
    }

    private function prepareHtmlForTelegram(string $html): string
    {
        // Заголовки
        $html = preg_replace('/<(h[1-6])[^>]*>/i', "\n", $html);
        $html = preg_replace('/<\/h[1-6]>/i', "\n", $html);

        // Абзацы
        $html = preg_replace('/<p[^>]*>/i', "\n", $html);
        $html = preg_replace('/<\/p>/i', "\n", $html);

        // Списки
        $html = preg_replace('/<li[^>]*>/i', "\n• ", $html);
        $html = preg_replace('/<\/li>/i', "", $html);
        $html = preg_replace('/<\/?(ul|ol)[^>]*>/i', "\n", $html);

        return $html;
    }

    private function normalizeContentText(string $text): string
    {
        // Нормализация переносов
        $text = str_replace(["\r\n", "\r"], "\n", $text);

        // Склеиваем маркер списка с текстом
        $text = preg_replace("/•\s*\n\s*/", "• ", $text);

        // Убираем пробелы в пустых строках
        $text = preg_replace("/[ \t]+\n/", "\n", $text);

        // Сводим 2+ пустых строк к одной
        $text = preg_replace("/\n{3,}/", "\n\n", $text);

        return trim($text);
    }

    private function normalizePlaceholders(string $template): string
    {
        return preg_replace('/\{\{\s*(.*?)\s*\}\}/', '{{$1}}', $template);
    }

    private function getApiUrl(string $method): string
    {
        return sprintf(
            'https://api.telegram.org/bot%s/%s',
            setting('telegram_token'),
            $method
        );
    }

    private function getChatId(): string
    {
        return setting('telegram_chat_id');
    }

    private function isSilentMode(): bool
    {
        return setting('telegram_send_without_sound') == 1;
    }

    private function logResponse($response): void
    {
        Log::info('Telegram API response', [
            'status' => $response->status(),
            'body' => $response->json(),
        ]);
    }
}
