<?php

namespace App\Http\Controllers\Public\Comment;

use App\Enums\CommentStatus;
use App\Http\Requests\Public\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Post;

class StoreController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->back()->with('success', __('post.comment.comment_added'));
    }
}
