<?php

namespace App\Http\Controllers\Admin\Setting\FooterLink;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;
use Exception;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FooterLink $link)
    {
        try {
            $link->delete();
            return redirect()->route('admin.setting.footerlink.index')->with('success', __('admin/settings/footerlink.messages.deleted', ['title' => $link->title]));
        } catch (Exception $ex) {
            
            logger()->error('Setting delete failed', ['exception' => $ex]);
            return redirect()->back()->with('error', __('errors/setting.delete.failed'));
        }
    }
}
