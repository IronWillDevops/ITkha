<?php

namespace App\Http\Controllers\Admin\Setting\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Contact $contact)
    {

         return view('admin.contact.show', compact('contact')); // Можно заменить на вашу главную страницу
    }
}
