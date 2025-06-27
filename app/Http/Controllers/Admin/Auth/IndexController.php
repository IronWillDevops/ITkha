<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function __invoke(): View
    {
        return view('admin.pages.auth.index');
    }
}
