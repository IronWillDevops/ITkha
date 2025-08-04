<?php

namespace App\Http\Controllers\Public\Auth\Register;

use App\Http\Controllers\Controller;
use App\Services\Public\UserService;

class BaseController extends Controller
{
    public $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}