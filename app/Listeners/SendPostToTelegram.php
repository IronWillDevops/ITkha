<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Services\Admin\TelegramPublisherService;

class SendPostToTelegram
{
    public function __construct(
        private TelegramPublisherService $publisher
    ) {}

    public function handle(PostPublished $event): void
    {
        $this->publisher->publish($event->post);
    }
}
