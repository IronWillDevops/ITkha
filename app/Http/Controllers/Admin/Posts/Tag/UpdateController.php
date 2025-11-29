<?php

namespace App\Http\Controllers\Admin\Posts\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\Tag\UpdateRequest;

use App\Models\Tag;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);

        return redirect()->route('admin.tag.show', $tag->id)->with('success', __('admin/tags.messages.edit', ['title' => $tag->title]));
    }
}
