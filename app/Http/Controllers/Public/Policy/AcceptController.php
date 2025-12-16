<?php

namespace App\Http\Controllers\Public\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy;

class AcceptController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke()
    {
        $policy = Policy::where('key', 'policy')
            ->where('is_active', true)
            ->firstOrFail();

        auth()->user()->acceptedPolicies()->syncWithoutDetaching([
            $policy->id => [
                'accepted_at' => now(),
                'version' => $policy->version,
            ],
        ]);

        return redirect()->intended('/');
    }
}
