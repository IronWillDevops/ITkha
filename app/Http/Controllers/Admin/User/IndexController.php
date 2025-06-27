<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $users = User::All();
        return view('admin.pages.user.index', compact('users')); // Можно заменить на вашу главную страницу
    }
}
