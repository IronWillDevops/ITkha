<?php

namespace App\Http\Middleware;

use App\Models\Policy;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// app/Http/Middleware/EnsurePolicyAccepted.php
class EnsurePolicyAccepted
{
    public function handle($request, Closure $next)
    {
        $policy = Policy::where('key', 'usage_policy')
            ->where('is_active', true)
            ->first();

        if (
            $policy &&
            auth()->check() &&
            ! auth()->user()->acceptedPolicies->contains($policy->id)
        ) {
            return redirect()->route('policy.show');
        }

        return $next($request);
    }
}
