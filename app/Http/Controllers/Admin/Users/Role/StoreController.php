<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Http\Requests\Admin\Users\Role\StoreRequest;

class StoreController extends BaseController
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(StoreRequest $request)
  { 
    $data = $request->validated();
    $this->service->store($data);
    
    return redirect()->route('admin.role.index')->with('success', __('admin/role.messages.created', ['title' => $data['title']]));
  }
}
