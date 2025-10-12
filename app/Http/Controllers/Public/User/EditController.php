<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditController extends Controller
{
    use AuthorizesRequests;
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {

        $this->authorize('view', $user);
        // Завантажити зв’язок profile, або створити новий, якщо не існує
        if (!$user->relationLoaded('profile') || !$user->profile) {
            $user->loadMissing('profile');

            if (!$user->profile) {
                $user->profile()->create(); // створюємо порожній профіль
            }
        }

        return view('public.user.edit', compact('user'));
    }
}
