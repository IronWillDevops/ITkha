<?php

namespace App\Http\Middleware;

use App\UserStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserVerifiedAndStatus
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


        if ($user->status ===  UserStatus::PENDING->value) {
            Auth::logout();
            abort(403, 'Your account is pending verification.');
        }
        // Перевірка статусу користувача через match
        if ($user->status ===  UserStatus::BANNED->value) {
            Auth::logout();
            abort(403, 'You have been banned.');
        }

        if (!$user->status ===  UserStatus::ACTIVE->value) {
            Auth::logout();
            abort(403, 'Unknow account status');
        }




        return $next($request);
    }
}
