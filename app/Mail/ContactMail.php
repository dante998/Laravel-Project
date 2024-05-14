<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $name, public string $email, public string $content)
    {
        
    }

    /**
     * Build the message.
     * 
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact from my Laravel app.')->replyTo($this->email)->markdown('contacts.emails.contact');
    }
}
