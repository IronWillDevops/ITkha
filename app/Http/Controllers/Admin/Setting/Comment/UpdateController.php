<?php

namespace App\Http\Controllers\Admin\Setting\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Comment\UpdateRequest;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request)
    {
        try {
            $data = $request->validated();
            Setting::setMany([
                'comments_enabled'      => (bool)($data['comments_enabled'] ?? false),
                'comments_auto_approve' => (bool)($data['comments_auto_approve'] ?? false),
                'comments_filter_words' => $data['comments_filter_words'],
                'comments_links_policy' => $data['comments_links_policy'],
            ]);
            return redirect()
                ->route('admin.setting.comment.edit')
                ->with('success',  __('admin/common.messages.settings_saved'));
        } catch (Exception $ex) {
            logger()->error('Setting update failed', ['exception' => $ex]);
            return redirect()->back()->with('error', __('errors/setting.update.failed'));
        }
    }
}
