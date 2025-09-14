<?php

namespace App\Http\Controllers\Admin\FooterLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterLink\UpdateRequest;
use App\Models\FooterLink;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(UpdateRequest $request, FooterLink $link)
  {

    $data = $request->validated();
    $link->update($data);
    return redirect()->route('admin.footerlink.show', $link->id)->with('success', __('admin/footerlink.messages.edit', ['title' => $link->title]));
  }
}
