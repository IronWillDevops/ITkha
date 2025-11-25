<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Response;

class TrustProxies extends Middleware
{
    protected $proxies = env('TRUSTED_PROXIES', null);

    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
