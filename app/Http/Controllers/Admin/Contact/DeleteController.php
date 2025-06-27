<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    //
    public function __invoke(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('toast', [
                'type' => 'success', // success | info | warning | danger
                'title' => 'Success',
                'message' =>'Message successfully deleted',
            ]);;
    }
}
