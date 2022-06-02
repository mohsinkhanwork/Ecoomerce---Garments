<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*return $this->view('view.name');*/
        //$this->msg['subject_email']
        return $this->from('noreply@urban-enigma.com', 'Contact Form - Urban')
                    ->subject('New Contact Form Submitted!')
                    ->markdown('emails.contact')
                    ->with('msg', $this->msg);
    }
}
