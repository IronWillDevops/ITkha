<?php

namespace App\Http\Controllers\Public\Sitemap;

use App\Http\Controllers\Controller;
use App\Services\Public\SitemapService;

class SectionController extends Controller
{
    private const ALLOWED_TYPES = ['posts'];

    public function __invoke(string $type, int $page, SitemapService $sitemapService)
    {
        abort_if(! in_array($type, self::ALLOWED_TYPES, strict: true), 404);

        $items = $sitemapService->getPostSection($page);

        abort_if($items->isEmpty(), 404);

        return response()
            ->view('public.sitemap.section', compact('items'))
            ->header('Content-Type', 'text/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
