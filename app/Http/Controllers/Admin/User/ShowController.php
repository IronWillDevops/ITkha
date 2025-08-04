<?php

namespace App\Http\Controllers\Admin\User;


use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        
        return view('admin.pages.user.show', compact('user')); // Можно заменить на вашу главную страницу
    }
}
