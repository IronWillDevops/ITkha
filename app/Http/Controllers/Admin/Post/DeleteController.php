<?php

namespace App\Http\Controllers\Admin\Post;
use App\Models\Post;

class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index')->with('success', __('admin/posts.messages.delete', ['title' => $post->title]));
    }
}
