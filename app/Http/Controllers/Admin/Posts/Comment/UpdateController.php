<?php

namespace App\Http\Controllers\Admin\Posts\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\Comment\UpdateRequest;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Comment $comment)
    {
        try {
            $data = $request->validated();
            $comment->update($data);

            return redirect()->route('admin.comment.show', $comment->id)->with('success', __('admin/comment.messages.updated', ['body' => $data['body']]));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('errors/comment.update.failed'));
        }
    }
}
