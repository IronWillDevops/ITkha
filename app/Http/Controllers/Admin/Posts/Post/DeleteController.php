<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Models\Post;
use Exception;

class DeleteController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('admin.post.index')->with('success', __('admin/post.messages.deleted', ['title' => $post->title]));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('errors/post.delete.failed'));
        }
    }
}
