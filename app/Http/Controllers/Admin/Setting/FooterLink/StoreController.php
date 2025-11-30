<?php

namespace App\Http\Controllers\Admin\Setting\FooterLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\FooterLink\StoreRequest;
use App\Models\FooterLink;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        FooterLink::firstOrCreate($data);

        return redirect()->route('admin.setting.footerlink.index')->with('success', __('admin/settings/footerlink.messages.created', ['title' => $data['title']]));
    }
}
