<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!auth()->check()) {
            abort(403, 'Unknow user');
        }

        // if (!$user->hasVerifiedEmail()) {
        //     abort(403, 'Please confirm your email address before you leave.');
        // }


        if (!$user->is_active) {
            auth()->logout();
            abort(403, 'Account is blocked');
        }


        if (!$user->hasPermission('admin_access')) {
            abort(403, 'Doesn`t have permission');
        }
     



        return $next($request);
    }
}
