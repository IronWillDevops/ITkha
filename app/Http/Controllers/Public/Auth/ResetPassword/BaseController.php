<?php

namespace App\Http\Controllers\Public\Auth\ResetPassword;

use App\Http\Controllers\Controller;
use App\Services\Public\Auth\ResetPasswordService;

class BaseController extends Controller
{
    public $service;
    public function __construct(ResetPasswordService $service)
    {
        $this->service = $service;
    }
}