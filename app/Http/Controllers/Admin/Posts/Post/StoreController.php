<?php

namespace App\Http\Controllers\Admin\Posts\Post;



use App\Http\Requests\Admin\Posts\Post\StoreRequest;


class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data, $request);

        return redirect()->route('admin.post.index')->with('success', __('admin/post.messages.created', ['title' => $data['title']]));
    }
}
