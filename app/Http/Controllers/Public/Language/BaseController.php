<?php

namespace App\Http\Controllers\Public\Language;

use App\Http\Controllers\Controller;
use App\Services\Public\Language\LanguageService;

class BaseController extends Controller
{
    public $service;
    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }
}