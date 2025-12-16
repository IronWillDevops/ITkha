<?php

namespace App\Services\Public;

use App\Enums\CommentStatus;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentService
{
    public function handle(array $data)
    {

        $post = Post::findOrFail($data['post_id']);

        if (! $post->comments_enabled) {
            abort(403, __('public/comment.labels.comments_disabled'));
        }

        $body = $data['body'];

        // Фильтрация запрещённых слов
        $filterWords = array_filter(array_map('trim', explode(',', Setting::get('comments_filter_words') ?? '')));
        foreach ($filterWords as $word) {
            if ($word !== '' && str_contains(mb_strtolower($body), mb_strtolower($word))) {
                return Redirect::back()->withInput()->with('error', __('public/comment.messages.contains_prohibited_words'));
            }
        }

        // Проверка ссылок
        $linkPolicy = Setting::get('comments_links_policy');
        if ($linkPolicy === 'reject' && preg_match('/https?:\/\//', $body)) {
            return Redirect::back()->withInput()->with('error', __('public/comment.messages.links_not_allowed'));
        }
        if ($linkPolicy === 'remove') {
            $body = preg_replace('/https?:\/\/\S+/', '', $body);
        }

        // Проверка на пустоту
        if (trim(strip_tags($body)) === '') {
            return Redirect::back()->withInput()->with('error', __('public/comment.messages.comment_cannot_be_empty'));
        }

        // Статус
        $status = (int)Setting::get('comments_auto_approve', 0)
            ? CommentStatus::APPROVED
            : CommentStatus::PENDING;

        Comment::create([
            'post_id' => $data['post_id'],
            'user_id' => Auth::id(),
            'body' => $body,
            'parent_id' => $data['parent_id'] ?? null,
            'status' => $status,
        ]);
        return Redirect::back()->with('success', __('public/comment.messages.comment_added'));
    }

    public function latestComment(int $limit = 5)
    {
        return Comment::where('status', CommentStatus::APPROVED)
            ->latest()
            ->take($limit)
            ->get();
    }
}
