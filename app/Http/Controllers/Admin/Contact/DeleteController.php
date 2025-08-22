<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    //
    public function __invoke(Request $request)
    {

        $ids = $request->input('selected'); // <-- правильно!

        if ($ids && is_array($ids)) {
            Contact::whereIn('id', $ids)->delete();
            return redirect()->back()->with('toast', [
                'type' => 'success', // success | info | warning | danger
                'title' => 'Success',
                'message' => 'Message(s) successfully deleted',
            ]);
        }

        return redirect()->back()->with('toast', [
            'type' => 'danger',
            'title' => 'Error',
            'message' => 'You have not selected any letter.',
        ]);
    }
}
