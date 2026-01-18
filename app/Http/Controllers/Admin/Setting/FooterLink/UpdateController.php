<?php

namespace App\Http\Controllers\Admin\Setting\FooterLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\FooterLink\UpdateRequest;
use App\Models\FooterLink;
use Exception;

class UpdateController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(UpdateRequest $request, FooterLink $link)
  {
    try {
      $data = $request->validated();
      $link->update($data);
      return redirect()->route('admin.setting.footerlink.show', $link->id)->with('success', __('admin/settings/footerlink.messages.updated', ['title' => $link->title]));
    } catch (Exception $ex) {
      
            logger()->error('Setting update failed', ['exception' => $ex]);
      return redirect()->back()->with('error', __('errors/setting.update.failed'));
    }
  }
}
