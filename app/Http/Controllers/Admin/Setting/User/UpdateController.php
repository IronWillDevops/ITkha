<?php

namespace App\Http\Controllers\Admin\Setting\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\User\UpdateRequest;
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

        Setting::set('user_default_status', $data['user_default_status']);
        Setting::set('user_default_role', $data['user_default_role']);
        Setting::set('user_require_email_verification',(bool) $data['user_require_email_verification']);

        return redirect()
            ->route('admin.setting.user.edit')
            ->with('success', __('admin/settings.updated'));
    }
}
