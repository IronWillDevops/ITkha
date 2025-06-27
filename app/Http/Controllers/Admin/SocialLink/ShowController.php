<?php

namespace App\Http\Controllers\Admin\SocialLink;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SocialLink $link)
    {
          return view('admin.pages.social.show',compact('link')); // Можно заменить на вашу главную страницу

    }
}
