<?php

namespace App\Http\Controllers\Public\Page\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\ContactFormRequest;
use App\Models\Contact;


class StoreController extends Controller
{
    public function __invoke(ContactFormRequest $request)
    {
        $data = $request->validated();     
        Contact::create($data);
        
        return redirect()->route('public.post.index')->with('success', __('form.message.send_message'));
    }
}
