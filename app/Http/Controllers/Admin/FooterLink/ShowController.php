<?php

namespace App\Http\Controllers\Admin\FooterLink;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\FooterLink;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FooterLink $link)
    {
          return view('admin.footerlink.show',compact('link')); // Можно заменить на вашу главную страницу

    }
}
