<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $replyMessage;
    public $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact, string $replyMessage, string $subjectLine)
    {
        $this->contact = $contact;
        $this->replyMessage = $replyMessage;
        $this->subjectLine = $subjectLine;
    }

    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Contact Reply Mail',
    //     );
    // }
    public function build()
    {
        return $this->from(config('mail.from.address'), config('app.name'))
            ->subject($this->subjectLine)
            ->view('emails.contact_reply');
    }

}
