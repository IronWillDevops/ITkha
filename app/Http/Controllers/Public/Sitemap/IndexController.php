<?php

namespace App\Http\Controllers\Public\Sitemap;

use App\Http\Controllers\Controller;
use App\Services\Public\SitemapService;

class IndexController extends Controller
{
      public function __invoke(SitemapService $sitemapService)
    {
        $count = $sitemapService->getPostSitemapCount();

        $sitemaps = collect()
            ->range(1, $count)
            ->map(fn (int $page) => [
                'loc'     => route('public.sitemap.section', ['type' => 'posts', 'page' => $page]),
                'lastmod' => now()->toAtomString(),
            ])
            ->push([
                'loc'     => route('public.sitemap.pages'),
                'lastmod' => now()->toAtomString(),
            ]);

        return response()
            ->view('public.sitemap.index', compact('sitemaps'))
            ->header('Content-Type', 'text/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
