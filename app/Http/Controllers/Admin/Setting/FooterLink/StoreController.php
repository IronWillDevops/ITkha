<?php

namespace App\Http\Controllers\Admin\Setting\FooterLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterLink\StoreRequest;
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

        return redirect()->route('admin.footerlink.index')->with('success', __('admin/footerlink.messages.create', ['title' => $data['title']]));
    }
}
