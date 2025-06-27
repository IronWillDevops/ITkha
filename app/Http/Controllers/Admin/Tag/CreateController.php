<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
  public function __invoke()
    {
        return view('admin.pages.tag.create'); // Можно заменить на вашу главную страницу
    }
}
