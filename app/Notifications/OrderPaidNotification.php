<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPaidNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Order $order
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject('Sue pedido foi processado')
            ->line('Status do Pedido: ' . $this->order->status);

        $items = $this->order->orderItems;
        $mailMessage->line('produtos:');

        foreach ($items as $item) {
            $product = $item->product;
            $mailMessage->line(
                $product->nome .
                ' quantidade: ' . $item->quantidade .
                ' preço: R$ '  . $item->preco / 100
            );
        }

        $mailMessage->line(
            'Valor Total: R$ ' . $this->order->valor_total / 100
        );

        return $mailMessage;
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
