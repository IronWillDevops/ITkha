<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Setting;
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
    $commentsEnabled = (bool) Setting::get('comments_enabled');
    return view('admin.posts.post.create', compact('categories', 'tags', 'users', 'status', 'commentsEnabled')); // Можно заменить на вашу главную страницу
  }
}
