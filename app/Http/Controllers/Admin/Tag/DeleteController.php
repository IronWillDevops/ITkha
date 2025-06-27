<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tag.index');
    }
}
