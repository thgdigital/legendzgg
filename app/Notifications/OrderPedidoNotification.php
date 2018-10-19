<?php

namespace App\Notifications;

use App\Models\OrderPedido;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class OrderPedidoNotification extends Notification
{
    use Queueable, SerializesModels;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $orderPedido;


    public function __construct(OrderPedido $orderPedido)
    {
        //

        $this->orderPedido = $orderPedido;
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

                     ->subject("Novo Peido")
                    ->markdown('emails.pagamento', ['orderPedido'=> $this->orderPedido]);
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
