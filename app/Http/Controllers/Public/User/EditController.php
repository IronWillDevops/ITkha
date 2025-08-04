<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditController extends BaseController
{
    use AuthorizesRequests;
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {

        $this->authorize('viewPublic', $user);
        $this->service->ensureProfileExists($user);

        return view('public.user.edit', compact('user'));
    }
}
