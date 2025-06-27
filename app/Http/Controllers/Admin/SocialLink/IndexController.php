<?php

namespace App\Http\Controllers\Admin\SocialLink;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $socialLinks  = SocialLink::all();
        return view('admin.pages.social.index', compact('socialLinks'));
    }
}
