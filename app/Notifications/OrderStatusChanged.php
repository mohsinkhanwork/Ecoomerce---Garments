<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusChanged extends Notification
{
    use Queueable;

    protected $order_detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order_detail)
    {
        $this->order_detail = $order_detail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            //->from(env('ADMIN_MAIL'))
            ->from('order@urban-enigma.com', 'Urban Enigma')
            ->subject('Your order status changed')
            ->greeting(sprintf('Hello %s', $this->order_detail['name']))
            ->line('Your order # '.$this->order_detail['order_id'])
            ->line('Your order status is now '.$this->order_detail['order_status'])
            //->action('Click Here', route('activate.user', $user->activation_code))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
