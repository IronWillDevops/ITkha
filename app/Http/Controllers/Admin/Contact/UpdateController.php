<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class UpdateController extends Controller
{
    public function __invoke(Contact $contact)
    {
        $contact->update(['is_read' => !$contact->is_read]);

        return back()->with('success', 'Message marked as read.');
    }
}
