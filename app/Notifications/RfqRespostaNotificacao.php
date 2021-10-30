<?php

namespace App\Notifications;

use App\Models\Rfqreposta;
use App\Models\Empresa;
use App\Models\Rfq;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RfqRespostaNotificacao extends Notification
{
    use Queueable;
    private $produto;
    private $rfq;
    private $empresa;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(String $produto, Empresa $empresa, Rfq $rfq)
    {
        $this->produto = $produto;
        $this->rfq = $rfq;
        $this->empresa = $empresa;
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
        $url = route('sistema.dash.comprador.rfqs');

        return (new MailMessage)
          ->subject('88 Market - RFQ 88 Market')
          ->greeting('Olá ' . $notifiable->nome . '!')
          ->line('Acabaram de responder a sua solicitação no portal 88 Market:')
          ->line('**' . $this->produto . '**')
          ->line('Acesse o painel de controle dentro do portal com as suas credenciais, e tire suas duvidas com o vendedor interessado emt em atender')          
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
