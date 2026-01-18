<?php

namespace App\Http\Controllers\Admin\Posts\Tag;

use App\Exceptions\Tag\CannotDeleteTagWithPostsException;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Exception;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag)
    {
        try {
            $tag->delete();
            return redirect()->route('admin.tag.index')->with('success', __('admin/tag.messages.deleted', ['title' => $tag->title]));
        } catch (CannotDeleteTagWithPostsException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('errors/tag.delete.failed'));
        }
    }
}
