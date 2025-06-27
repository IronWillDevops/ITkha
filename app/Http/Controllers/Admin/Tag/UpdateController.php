<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\UpdateRequest;

use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
          return view('admin.pages.tag.show', compact('tag')); // Можно заменить на вашу главную страницу
 
    }
}
