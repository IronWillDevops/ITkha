<?php

namespace App\Http\Middleware;

use App\Models\Policy;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

// app/Http/Middleware/EnsurePolicyAccepted.php
class EnsurePolicyAccepted
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // If the user is not authenticated, just continue
        if (! auth()->check()) {
            return $next($request);
        }

        // Check if the current session still exists in the database
        // This ensures immediate logout if the session was deleted
        $sessionExists = DB::table('sessions')
            ->where('id', session()->getId())
            ->exists();

        if (! $sessionExists) {
            // Force logout for current user
            Auth::logout();

            // Invalidate current session and regenerate CSRF token
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect to login page with message
            return redirect()->route('login')->with('success', __('public/user.messages.logged_out_session_deleted'));
        }

        // Retrieve the active policy from DB
        $policy = Policy::where('key', 'policy')
            ->where('is_active', true)
            ->first();

        // If no active policy, continue
        if (! $policy) {
            return $next($request);
        }

        // Check if the authenticated user has accepted the current version of the policy
        $accepted = auth()->user()
            ->acceptedPolicies()
            ->where('policy_id', $policy->id)
            ->wherePivot('version', $policy->version)
            ->exists();

        // If policy not accepted and route is not whitelisted, redirect to policy page
        if (! $accepted
            && ! $request->routeIs('policy.*')
            && ! $request->routeIs('locale.*')
            && ! $request->routeIs('admin.*')
        ) {
            return redirect()->route('policy.show');
        }

        // Everything is fine, continue request
        return $next($request);
    }
}