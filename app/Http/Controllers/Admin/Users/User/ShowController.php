<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Models\User;

class ShowController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $posts = $user->posts()->paginate(10);

        return view('admin.users.user.show', compact('user', 'posts')); // Можно заменить на вашу главную страницу
    }
}
