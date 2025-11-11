<?php

namespace App\Http\Controllers\Admin\Setting\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $contacts = Contact::orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.contact.index', compact('contacts'));
    }
}
