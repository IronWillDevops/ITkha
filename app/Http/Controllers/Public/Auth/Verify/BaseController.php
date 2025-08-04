<?php

namespace App\Http\Controllers\Public\Auth\Verify;

use App\Http\Controllers\Controller;
use App\Services\Public\Auth\VerifyService;

class BaseController extends Controller
{
    public $service;
    public function __construct(VerifyService $service)
    {
        $this->service = $service;
    }
}