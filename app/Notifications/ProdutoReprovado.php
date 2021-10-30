<?php

namespace App\Notifications;

use App\Models\Produto;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProdutoReprovado extends Notification
{
    use Queueable;

    protected $produto;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
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
        $url = route('sistema.produto', $this->produto->slug);

        return (new MailMessage)
          ->subject('88 Market - Reprovação de produto')
          ->greeting('Olá ' . $notifiable->nome . '!')
          ->line('O seu produto **' . $this->produto->nome . '** foi reprovado devido a:')
          ->line('**' . $this->produto->motivo_rejeicao . '**')
          ->line('Por favor, verifique a nossa política.');
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
