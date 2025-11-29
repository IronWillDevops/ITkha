<?php

namespace App\Http\Controllers\Admin\Users\User;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;

class BaseController extends Controller
{
    public $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
