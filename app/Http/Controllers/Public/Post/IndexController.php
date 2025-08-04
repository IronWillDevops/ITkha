<?php

namespace App\Http\Controllers\Public\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Post\FilterRequest;

use App\Enums\PostStatus;

class IndexController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterRequest $request)
    {

        $data = $request->validated();

        $posts = $this->service->getFilteredPosts($data);

        $categories = $this->service->getAllCategories();
        $tags = $this->service->getAllTags();
        $popularPosts = $this->service->popularPosts();

        return view('public.post.index', compact('posts', 'categories', 'tags', 'popularPosts'));
    }
}
