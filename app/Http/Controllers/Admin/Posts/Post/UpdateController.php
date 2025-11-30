<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Http\Requests\Admin\Posts\Post\UpdateRequest;
use App\Models\Post;


class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $post = $this->service->update($data, $request, $post);
        return redirect()->route('admin.post.show', $post)->with('success', __('admin/post.messages.updated', ['title' => $data['title']]));
    }
}
