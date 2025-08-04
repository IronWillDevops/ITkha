<?php

namespace App\Http\Controllers\Public\Auth\ReVerification;

use App\Http\Controllers\Controller;
use App\Services\Public\Auth\ReVerificationService;

class BaseController extends Controller
{
    public $service;
    public function __construct(ReVerificationService $service)
    {
        $this->service = $service;
    }
}