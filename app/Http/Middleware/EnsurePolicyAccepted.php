<?php

namespace App\Http\Middleware;

use App\Models\Policy;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// app/Http/Middleware/EnsurePolicyAccepted.php
class EnsurePolicyAccepted
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check()) {
            return $next($request);
        }

        $policy = Policy::where('key', 'policy')
            ->where('is_active', true)
            ->first();

        if (! $policy) {
            return $next($request);
        }

        $accepted = auth()->user()
            ->acceptedPolicies()
            ->where('policy_id', $policy->id)
            ->wherePivot('version', $policy->version)
            ->exists();

        if (! $accepted && ! $request->routeIs('policy.*') && ! $request->routeIs('locale.*') && ! $request->routeIs('admin.*')) {
            return redirect()->route('policy.show');
        }

        return $next($request);
    }
}
