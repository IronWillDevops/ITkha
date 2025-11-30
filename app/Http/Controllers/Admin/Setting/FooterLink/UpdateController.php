<?php

namespace App\Http\Controllers\Admin\Setting\FooterLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\FooterLink\UpdateRequest;
use App\Models\FooterLink;

class UpdateController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(UpdateRequest $request, FooterLink $link)
  {

    $data = $request->validated();
    $link->update($data);
    return redirect()->route('admin.setting.footerlink.show', $link->id)->with('success', __('admin/settings/footerlink.messages.updated', ['title' => $link->title]));
  }
}
