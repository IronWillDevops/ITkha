<?php

namespace App\Http\Controllers\Public\Page\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\ContactFormRequest;
use App\Models\Contact;


class StoreController extends Controller
{
    public function __invoke(ContactFormRequest $request)
    {
        $validated = $request->validated();

        // Тут можна зберегти в БД, надіслати повідомлення тощо
        
        Contact::create($validated);
        // Задання флеш-повідомлення і цільової адреси
        return redirect()->route('public.post.index')->with('success',__('public/contact.messages.send_message'));
    }
}
