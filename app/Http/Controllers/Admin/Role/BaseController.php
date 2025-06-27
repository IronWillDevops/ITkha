<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Services\Admin\RoleService;

class BaseController extends Controller
{
    public $service;
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }
}
