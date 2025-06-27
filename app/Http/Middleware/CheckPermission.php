<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        
        $user = Auth::user();

        if (!$user || !$user->hasPermission($permission)) {
            abort(Response::HTTP_FORBIDDEN, 'Access denied');
        }
        return $next($request);
    }
}
