<?php

namespace App\Services\Public;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;


class SitemapService
{
    private int $limit;
    private int $ttl;

    public function __construct()
    {
        $this->limit = config('sitemap.limit');
        $this->ttl   = config('sitemap.cache.ttl');
    }

    public function getPostSitemapCount(): int
    {
        return Cache::tags(['sitemap', 'posts'])
            ->remember('sitemap.posts.count', $this->ttl, function () {
                $count = Post::query()
                    ->where('status', PostStatus::PUBLISHED)
                    ->count();

                return (int) ceil($count / $this->limit);
            });
    }

    /**
     * @return Collection<int, array{loc: string, lastmod: string}>
     */
    public function getPostSection(int $page): Collection
    {
        return Cache::tags(['sitemap', 'posts'])
            ->remember("sitemap.posts.page.{$page}", $this->ttl, function () use ($page) {
                return Post::query()
                    ->where('status', PostStatus::PUBLISHED)
                    ->orderBy('id')
                    ->offset(($page - 1) * $this->limit)
                    ->limit($this->limit)
                    ->get()
                    ->map(static fn(Post $post) => [
                        'loc'     => route('public.post.show', $post),
                        'lastmod' => $post->updated_at?->toAtomString(),
                    ]);
            });
    }

    /**
     * @return Collection<int, array{loc: string, lastmod: string}>
     */
    public function getStaticPages(): Collection
    {
        return Cache::tags(['sitemap'])
            ->remember('sitemap.static', $this->ttl, function () {
                $now = now()->toAtomString();

                return collect([
                    ['loc' => route('public.post.index'),           'lastmod' => $now],
                    ['loc' => route('policy.show'),                  'lastmod' => $now],
                    ['loc' => route('public.pages.contact.index'),   'lastmod' => $now],
                ]);
            });
    }

    public function clear(): void
    {
        Cache::tags(['sitemap'])->flush();
    }
}
