<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Http\Requests\Admin\Users\Role\StoreRequest;
use Exception;

class StoreController extends BaseController
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(StoreRequest $request)
  {
    try {
      $data = $request->validated();
      $this->service->store($data);

      return redirect()->route('admin.role.index')->with('success', __('admin/role.messages.created', ['title' => $data['title']]));
    } catch (Exception $ex) {
      logger()->error('Role store failed', ['exception' => $ex]);
      return redirect()->back()->with('error', __('errors/role.delete.failed'));
    }
  }
}
