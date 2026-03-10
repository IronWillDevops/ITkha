<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $data = [
            'postCount' => Post::count(),
            'categoryCount' => Category::count(),
            'tagCount' => Tag::count(),
            'userCount' => User::count(),
            'commentCount' => Comment::count(),
            'logCount' => ActivityLog::count(),
        ];

        return view('admin.dashboard.index', $data);
    }
}
