<?php

namespace App\Http\Controllers\Admin\Setting\Contact;
use App\Mail\ContactReplyMail;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReplyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'min:3'],
        ]);

        // Тема листа
        $subject = "Request Ticket#{$contact->id} - {$contact->subject}";

        // Відправка листа через Mailable
         Mail::to($contact->email)->send(new ContactReplyMail($contact, $validated['message'], $subject));

        // Можна відмітити, що контакт оброблено
        $contact->update(['is_read' => true]);

        return redirect()
            ->route('admin.setting.contact.show', $contact)
            ->with('success', 'Відповідь успішно надіслано.');
    }
}
