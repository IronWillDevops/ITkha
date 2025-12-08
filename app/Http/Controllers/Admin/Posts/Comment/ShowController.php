<?php

namespace App\Http\Controllers\Admin\Posts\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
      public function __invoke(Comment $comment)
    {
        // Формируем коллекцию постов для таблицы
        $posts = collect();
        if ($comment->post) {
            $posts->push($comment->post);
        }

        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'title', 'label' => __('admin/common.fields.title')],
            ['key' => 'status', 'label' => __('admin/common.fields.status')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        return view('admin.posts.comment.show', compact('comment', 'posts', 'columns'));
    }
}
