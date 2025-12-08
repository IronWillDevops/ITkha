<?php

namespace App\Http\Controllers\Admin\Posts\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'body', 'label' => __('admin/comment.fields.body'), 'wrap' => true],
            ['key' => 'user.login', 'label' => __('admin/common.fields.author')],
            ['key' => 'post.title', 'label' => __('admin/common.fields.post')],
            ['key' => 'status', 'label' => __('admin/common.fields.status')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        $validSortFields = ['id', 'body', 'status', 'created_at', 'user.login', 'post.title'];

        $validated = $request->validate([
            'sort_field' => ['nullable', 'string', 'in:' . implode(',', $validSortFields)],
            'sort_direction' => ['nullable', 'string', 'in:asc,desc'],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $sortField = $validated['sort_field'] ?? 'id';
        $sortDirection = $validated['sort_direction'] ?? 'desc';
        $search = $validated['search'] ?? null;

        $query = Comment::with('user', 'post');

        if ($search) {
            $query->where('body', 'like', "%{$search}%")
                ->orWhereHas('user', fn($q) => $q->where('login', 'like', "%{$search}%"))
                ->orWhereHas('post', fn($q) => $q->where('title', 'like', "%{$search}%"));
        }

        // Сортировка
        if ($sortField === 'user.login') {
            $query->join('users', 'users.id', '=', 'comments.user_id')
                ->orderBy('users.login', $sortDirection)
                ->select('comments.*');
        } elseif ($sortField === 'post.title') {
            $query->join('posts', 'posts.id', '=', 'comments.post_id')
                ->orderBy('posts.title', $sortDirection)
                ->select('comments.*');
        } else {
            $query->orderBy($sortField, $sortDirection);
        }

        $comments = $query->paginate(10);

        return view('admin.posts.comment.index', compact(
            'comments',
            'columns',
            'sortField',
            'sortDirection'
        ));
    }
}
