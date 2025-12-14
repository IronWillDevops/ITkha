<?php

namespace App\Http\Controllers\Public\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcceptController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke()
    {
        $policy = Policy::where('key', 'usage_policy')
            ->where('is_active', true)
            ->firstOrFail();

        auth()->user()->acceptedPolicies()->syncWithoutDetaching([
            $policy->id => ['accepted_at' => now(), 'version' => $policy->version],
        ]);

        return redirect()->intended('/');
    }
}
