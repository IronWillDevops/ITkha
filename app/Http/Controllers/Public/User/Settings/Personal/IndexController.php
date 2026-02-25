<?php

namespace App\Http\Controllers\Public\User\Settings\Personal;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        return view('public.user.settings.personal.index', compact('user'));
    }
}
