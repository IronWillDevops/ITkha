<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Models\Role;

class StoreController extends BaseController
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(StoreRequest $request)
  { 
    $data = $request->validated();
    $this->service->store($data);
    
    return redirect()->route('admin.role.index')->with('success', __('admin/roles.messages.create', ['title' => $data['title']]));
  }
}
