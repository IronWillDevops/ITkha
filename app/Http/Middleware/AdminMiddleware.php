<?php

namespace App\Http\Middleware;

use App\UserStatus;
use Closure;
use Illuminate\Http\Request;
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

        if (!$user->hasPermission('admin_access')) {
            abort(403, 'Doesn`t have permission');
        }
            return $next($request);
    }
}
