<?php

namespace App\Http\Controllers\Admin\Posts\Category;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
  public function __invoke()
  {
    return view('admin.posts.category.create'); // Можно заменить на вашу главную страницу
  }
}
