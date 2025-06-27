<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class CreateController extends BaseController
{
  public function __invoke()
  {
    $categories = Category::all();
    $tags = Tag::all();
    $users = User::all();
    return view('admin.pages.post.create', compact('categories', 'tags', 'users')); // Можно заменить на вашу главную страницу
  }
}
