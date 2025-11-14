<?php

namespace App\Http\Controllers\Admin\Setting\Contact;

use App\Mail\ContactReplyMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Contacts\ReplyRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ReplyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ReplyRequest $request, Contact $contact)
    {
        $validated = $request->validated();

        // Тема листа
        $subject = "Request Ticket#{$contact->id} - {$contact->subject}";

        // Відправка листа через Mailable
         Mail::to($contact->email)->send(new ContactReplyMail($contact, $validated['message'], $subject));

        $contact->update(['is_read' => true]);

        return redirect()
            ->route('admin.setting.contact.index', $contact)
            ->with('success', __('admin/contacts.messages.send'));
    }
}
