<?php

namespace App\Notifications;

use App\Models\Rfq;
use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RfqCriada extends Notification
{
    use Queueable;

    private $produto;
    private $rfq;
    private $usuario;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(String $produto, Usuario $usuario, Rfq $rfq)
    {
        $this->produto = $produto;
        $this->rfq = $rfq;
        $this->usuario = $usuario;
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
        $url = route('sistema.rfq.detalhes', $this->rfq->id);

        return (new MailMessage)
          ->subject('88 Market - RFQ 88 Market')
          ->greeting('Olá ' . $notifiable->nome . '!')
          ->line('Acabamos de receber uma nova cotação de produto:')
          ->line('**' . $this->produto . '**')
          ->line('no nosso sistema RFQ 88, esse produto está listado dentro da categoria em que você possui produtos semelhantes.')
          ->line('Estamos enviando esse comunicado, para lembrar que cada solicitação no RFQ 88 terá somente 10 respostas, então corra e seja o primeiro a responder.')
          ->action('Acesse aqui para nais detalhes', $url);
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
