<?php

namespace App\Http\Controllers\Public\Captcha;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Services\Public\Captcha\CaptchaService;

class CaptchaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CaptchaService $captchaService)
    {
        $imageData = $captchaService->generate();

        return response($imageData)->header('Content-Type', 'image/png');
    }
}
