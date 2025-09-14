<?php

namespace App\Http\Controllers\Admin\Post;



use App\Http\Requests\Admin\Post\StoreRequest;


class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data, $request);

        return redirect()->route('admin.post.index')->with('success', __('admin/posts.messages.create', ['title' => $data['title']]));
    }
}
