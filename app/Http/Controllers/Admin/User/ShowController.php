<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $posts = $user->posts()->paginate(10);

        return view('admin.user.show', compact('user', 'posts')); // Можно заменить на вашу главную страницу
    }
}
