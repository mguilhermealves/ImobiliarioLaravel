<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

use App\Models\Usuario;

class EnviarSenha extends Notification
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
        $usuario = Usuario::whereEmail($notifiable->email)->first();

        if ($usuario && $usuario->reset_token == null) {
            $nToken = Str::random(60);
            $usuario->reset_token = $nToken;
            $usuario->save();             
        }
        
        $url = route('sistema.auth.nova-senha',[$notifiable->id,$usuario->reset_token]);

        return (new MailMessage)
            ->subject('Asserttem - Acesso a área restrita')
            ->greeting('Olá ' . $notifiable->nome . '!')
            ->line('Foi criado um acesso para sua agência') 
            ->line('Clique no botão abaixo para ser direcionado ao site da Assertem e crie a sua senha de acesso.') 
            ->action('Criar senha', $url);          
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
