<?php

namespace App\Http\Controllers\Admin\Setting\FooterLink;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $footerlinks  = FooterLink::paginate(10);
        return view('admin.footerlink.index', compact('footerlinks'));
    }
}
