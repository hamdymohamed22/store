<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotf extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress();
        return (new MailMessage)
            ->subject("New Order Created Number {$this->order->number}")
            ->greeting("Hello {$notifiable->first_name},")
            // ->line('A new Order Created By' . $addr->name . 'from' . $addr->country_name)
            ->action('View Order', route('dashboard'))
            ->line('Thank you for using our application!');
        // ->view();
    }

    public function toDatabase($notifiable){
        $addr = $this->order->billingAddress();
        return [
            // "body" => "A new Order Created By' . $addr->first_name . 'from' . $addr->country_name",
            'icon' => 'fas fa-file',
            'url' => route('dashboard'),
            'order_id' => $this->order->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
