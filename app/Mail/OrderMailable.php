<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('emails.email');
        return $this->from('order@urban-enigma.com', 'Urban Enigma')
                    ->subject('New Order!')
                    ->markdown('emails.order_confirmation')
                    ->with('customer', $this->customer);
    }
}
