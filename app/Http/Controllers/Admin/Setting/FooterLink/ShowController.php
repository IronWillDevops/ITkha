<?php

namespace App\Http\Controllers\Admin\Setting\FooterLink;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FooterLink $link)
    {
          return view('admin.setting.footerlink.show',compact('link')); // Можно заменить на вашу главную страницу

    }
}
