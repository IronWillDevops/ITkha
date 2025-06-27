<?php

namespace App\Http\Controllers\Admin\Icons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.pages.icons.index'); // Можно заменить на вашу главную страницу
    }
}
