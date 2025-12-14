<?php

namespace App\Http\Controllers\Public\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke()
    {
        $policy = Policy::where('key', 'policy')
            ->where('is_active', true)
            ->with('translations')
            ->firstOrFail();

        $translation = $policy->translations
            ->firstWhere('locale', app()->getLocale())
            ?? $policy->translations
                ->firstWhere('locale', config('app.fallback_locale'));

        abort_unless($translation, 404);
        return view('public.policy.show', compact('policy', 'translation'));
    }
}

