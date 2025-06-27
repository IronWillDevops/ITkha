<?php

namespace App\Http\Controllers\Public\Page\Contact;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {

        return view('public.pages.contact.index');
    }
}
