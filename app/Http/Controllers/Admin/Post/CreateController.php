<?php

namespace App\Http\Controllers\Admin\Post;

use App\Enums\PostStatus;
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
    $status = PostStatus::cases();
    return view('admin.post.create', compact('categories', 'tags', 'users','status')); // Можно заменить на вашу главную страницу
  }
}
