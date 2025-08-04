<?php

namespace App\Http\Controllers\Public\Auth\Register;

use App\Http\Controllers\Controller;
use App\Services\Public\Auth\RegisterService;

class BaseController extends Controller
{
    public $service;
    public function __construct(RegisterService $service)
    {
        $this->service = $service;
    }
}