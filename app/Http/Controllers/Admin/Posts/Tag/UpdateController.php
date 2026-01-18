<?php

namespace App\Http\Controllers\Admin\Posts\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\Tag\UpdateRequest;

use App\Models\Tag;
use Exception;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Tag $tag)
    {
        try {
            $data = $request->validated();
            $tag->update($data);

            return redirect()->route('admin.tag.show', $tag->id)->with('success', __('admin/tag.messages.updated', ['title' => $tag->title]));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('errors/tag.update.failed'));
        }
    }
}
