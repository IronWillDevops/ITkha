<?php

namespace App\Http\Controllers\Admin\Posts\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\UpdateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,Comment $comment)
    {
        $data = $request->validated();
        $comment->update($data);
        
        return redirect()->route('admin.comment.show',$comment->id)->with('success', __('admin/comments.messages.edit', ['body' => $data['body']]));
    }
}
