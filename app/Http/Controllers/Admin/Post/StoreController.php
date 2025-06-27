<?php

namespace App\Http\Controllers\Admin\Post;



use App\Http\Requests\Admin\Post\StoreRequest;


class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data,$request);
       
        return redirect()->route('admin.post.index'); // Можно заменить на вашу главную страницу
    }
}
