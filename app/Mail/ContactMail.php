<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /** Create a new message instance. */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@vinylshop.com', 'The Vinyl Shop - News')
            ->cc('info@vinylshop.com', 'The Vinyl Shop - News')
            ->subject('The Vinyl Shop - Contact Form')
            ->markdown('email.contact');
    }
}
