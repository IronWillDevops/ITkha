<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
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

        return view('admin.pages.post.show', compact('post')); // Можно заменить на вашу главную страницу

    }
}
