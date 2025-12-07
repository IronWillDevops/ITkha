<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Events\PostPublished;
use App\Models\Post;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Publish posts that are scheduled for now or earlier';

    public function handle()
    {
        $now = date('Y-m-d H:i:s');

        $posts = Post::where('status', PostStatus::SCHEDULED->value)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $now)
            ->get();

        foreach ($posts as $post) {
            $post->status = PostStatus::PUBLISHED->value;
            $post->save();

            event(new PostPublished($post));

            $this->info("Post #{$post->id} published.");
        }


        return Command::SUCCESS;
    }
}
