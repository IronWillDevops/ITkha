<?php

namespace App\Http\Controllers\Admin\Users\Role;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class CreateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $permissions = Permission::all()->groupBy('header');
        return view('admin.users.role.create',compact('permissions')); 

    }
}
