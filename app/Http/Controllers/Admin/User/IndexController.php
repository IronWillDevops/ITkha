<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users')); // Можно заменить на вашу главную страницу
    }
}
