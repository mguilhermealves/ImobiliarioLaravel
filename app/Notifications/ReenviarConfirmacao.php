<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReenviarConfirmacao extends Notification
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
        
        $url = route('sistema.auth.confirmar', [$notifiable->usuario->id, $notifiable->usuario->confirmation_token]);
        return (new MailMessage)
            ->subject('88 Market - Confirmação de cadastro')
            ->greeting('Olá ' . $notifiable->usuario->nome . '!')
            ->line('Meu nome é Dai, sou fundador da 88 Market.')
            ->line('Gostaria de agradecer por fazer parte a nossa comunidade de 88 marketeiros, criamos uma plataforma especializada para o mercado de comércio atacadista.')
            ->line('Você é um fornecedor?')
            ->line('A seguir, vou te apresentar algumas instruções que possam ajudar a vender mais')
            ->line('<a href="https://youtu.be/Lm72DdxLYm8">1) Como postar novos produtos</a>')
            ->line('<a href="https://youtu.be/ka70kGbHCHM">2) Como criar o seu próprio mini site</a>')
            ->line('')
            ->line('Se você for um comprador:')
            ->line('')
            ->line('<a href="https://youtu.be/DQuevEnm8Ss">1) Como usar o nosso RFQ 88 para encontrar mais fornecedores ocultos e conseguir ofertas melhores.</a>')
            ->action('Confirmar cadastro', $url);
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
