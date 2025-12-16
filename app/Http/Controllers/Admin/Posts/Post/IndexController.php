<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {


        $columns = [
            ['key' => 'id', 'label' => 'ID'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'category.title', 'label' => 'Category'],
            ['key' => 'tags', 'label' => 'Tags'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Created At'],
        ];

        // Поля, доступные для сортировки
        $validSortFields = ['id', 'title', 'status', 'created_at', 'category.title', 'tags'];

        $validated = $request->validate([
            'sort_field' => ['nullable', Rule::in($validSortFields)],
            'sort_direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $sortField = $validated['sort_field'] ?? 'id';
        $sortDirection = $validated['sort_direction'] ?? 'desc';
        $search = $validated['search'] ?? null;
        $query = Post::query()->with('category', 'tags');

        // Поиск
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('posts.title', 'like', "%{$search}%")
                    ->orWhere('posts.content', 'like', "%{$search}%");
            });
        }

        // Сортировка
        if ($sortField === 'category.title') {
            $query->join('categories', 'categories.id', '=', 'posts.category_id')
                ->orderBy('categories.title', $sortDirection)
                ->select('posts.*');
        } elseif ($sortField === 'tags') {
            // сортировка по названию первого тега
            $query->leftJoin('post_tags', 'posts.id', '=', 'post_tags.post_id')
                ->leftJoin('tags', 'tags.id', '=', 'post_tags.tag_id')
                ->groupBy('posts.id')
                ->orderBy(DB::raw('MIN(tags.title)'), $sortDirection)
                ->select('posts.*');
        } else {
            $query->orderBy("posts.$sortField", $sortDirection); // явно указываем posts
        }

        $posts = $query->paginate(15);
        $tags = Tag::all();


        return view('admin.posts.post.index', compact('posts', 'tags', 'columns', 'sortField', 'sortDirection'));
    }
}
