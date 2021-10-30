<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BoasVindasComprador extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        
        $url = route('sistema.rfq.nova');
        return (new MailMessage)
            ->subject('Bem-Vindo ao 88Market')
            ->greeting('Olá ' . $notifiable->nome . '!')
            ->line('Meu nome é Jonathan, um dos fundadores da 88Market.')
            ->line('É uma grande satisfação para nós saber que nossa plataforma irá te auxiliar a encontrar os melhores preços do mercado.')
            ->line('Você é um comprador?')
            ->line('Vamos começar criando uma cotação no 88Market?')
            ->line('Comece agora!')            
            ->action('Criar cotação', $url);
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
