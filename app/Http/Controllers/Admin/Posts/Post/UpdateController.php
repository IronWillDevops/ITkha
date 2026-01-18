<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Http\Requests\Admin\Posts\Post\UpdateRequest;
use App\Models\Post;
use Exception;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Post $post)
    {
        try {
            $data = $request->validated();
            $post = $this->service->update($data, $request, $post);
            return redirect()->route('admin.post.show', $post)->with('success', __('admin/post.messages.updated', ['title' => $data['title']]));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('errors/post.update.failed'));
        }
    }
}
