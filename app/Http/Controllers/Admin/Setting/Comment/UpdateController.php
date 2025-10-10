<?php

namespace App\Http\Controllers\Admin\Setting\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Comment\UpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request)
    {

        $data = $request->validated();
    
        Setting::set('comments_auto_approve', (bool)$data['comments_auto_approve']);
        Setting::set('comments_filter_words', $data['comments_filter_words']);
        Setting::set('comments_links_policy', $data['comments_links_policy']);

        return redirect()
            ->route('admin.setting.comment.edit')
            ->with('success', __('admin/settings.updated'));
    }
}
