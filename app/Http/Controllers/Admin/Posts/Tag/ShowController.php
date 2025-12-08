<?php

namespace App\Http\Controllers\Admin\Posts\Tag;

use App\Http\Controllers\Controller;

use App\Models\Tag;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag, Request $request)
    {
        $columns = [
            ['key' => 'id', 'label' => 'ID'],
            ['key' => 'title', 'label' => __('admin/common.fields.title')],
            ['key' => 'status', 'label' => __('admin/common.fields.status')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        $sortField = $request->get('sort_field', 'id');
        $sortDirection = $request->get('sort_direction', 'desc');
        $search = $request->get('search');

        $query = $tag->posts();

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $query->orderBy($sortField, $sortDirection);

        $posts = $query->paginate(10);

        return view('admin.posts.tag.show', compact(
            'tag',
            'posts',
            'columns',
            'sortField',
            'sortDirection'
        ));
    }
}
