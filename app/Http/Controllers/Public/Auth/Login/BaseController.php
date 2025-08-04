<?php

namespace App\Http\Controllers\Public\Auth\Login;

use App\Http\Controllers\Controller;
use App\Services\Public\Auth\LoginService;

class BaseController extends Controller
{
    public $service;
    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }
}