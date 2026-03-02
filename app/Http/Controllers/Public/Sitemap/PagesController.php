<?php

namespace App\Http\Controllers\Public\Sitemap;

use App\Http\Controllers\Controller;
use App\Services\Public\SitemapService;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SitemapService $sitemapService)
    {
        $pages = $sitemapService->getStaticPages();

        return response()
            ->view('public.sitemap.pages', compact('pages'))
            ->header('Content-Type', 'text/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
