<?php

namespace App\Http\Controllers\Admin\Posts\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {$columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'title', 'label' => __('admin/common.fields.title')],
            ['key' => 'posts_count', 'label' => __('admin/common.fields.count')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        $validSortFields = ['id', 'title', 'created_at'];

        $validated = $request->validate([
            'sort_field' => ['nullable', Rule::in($validSortFields)],
            'sort_direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $sortField = $validated['sort_field'] ?? 'id';
        $sortDirection = $validated['sort_direction'] ?? 'asc';
        $search = $validated['search'] ?? null;

        $query = Tag::query()->withCount('posts');

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $query->orderBy($sortField, $sortDirection);

        $tags = $query->paginate(10);

        return view('admin.posts.tag.index', compact(
            'tags',
            'columns',
            'sortField',
            'sortDirection'
        ));
    }
}
