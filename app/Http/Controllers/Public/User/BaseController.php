<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Services\Public\User\UserService;

class BaseController extends Controller
{
    public $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}