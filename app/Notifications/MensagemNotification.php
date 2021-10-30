<?php

namespace App\Notifications;

use App\Models\Mensagem;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MensagemNotification extends Notification
{
    use Queueable;
    protected $mensagem;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mensagem $mensagem)
    {
        $this->mensagem = $mensagem;
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
        if ($this->mensagem->usuarioOrigem->id == $notifiable->id) {
            $nome = $this->mensagem->usuarioDestino->fullName;
            $uf = $this->mensagem->usuarioDestino->empresa->uf;
            $url = route('sistema.dash.vendedor');
        } else {
            $nome = $this->mensagem->usuarioOrigem->fullName;
            $uf = $this->mensagem->usuarioOrigem->empresa->uf;
            $url = route('sistema.dash.comprador');
        }

        return (new MailMessage)
        ->subject('88 Market - Nova mensagem')
        ->greeting('Olá ' . $notifiable->nome . '!')
        ->line('Você acabou de receber uma nova mensagem de:')
        ->line($nome . ' / ' . $uf)
        ->line('Para saber mais detalhes acesse seu painel 88.')
        ->action('Acessar seu painel 88', $url);
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
