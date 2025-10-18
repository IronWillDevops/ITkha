<?php

namespace App\Http\Controllers\Admin\Setting\Comment;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $commentsEnabled = (bool) Setting::get('comments_enabled');
        $autoApprove = (bool) Setting::get('comments_auto_approve');
        $filterWords = Setting::get('comments_filter_words');
        $linksPolicy = Setting::get('comments_links_policy');
        return view('admin.setting.comment.edit', compact('commentsEnabled','autoApprove', 'filterWords', 'linksPolicy'));
    }
}
