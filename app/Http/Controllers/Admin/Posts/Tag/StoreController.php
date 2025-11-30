<?php

namespace App\Http\Controllers\Admin\Posts\Tag;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Posts\Tag\StoreRequest;

use App\Models\Tag;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();

        Tag::firstOrCreate($data);
        return redirect()->route('admin.tag.index')->with('success', __('admin/tag.messages.created', ['title' => $data['title']]));
    }
}
