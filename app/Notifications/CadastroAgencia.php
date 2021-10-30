<?php

namespace App\Notifications;

use App\Http\Requests\Sistema\ContatoRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CadastroAgencia extends Notification
{
    use Queueable;

    private $request;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ContatoRequest $request)
    {
        $this->request = $request;
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
        ->subject('Site Assertem - Cadastro de Agência Associada')
        ->greeting('Olá ' . $notifiable->nome . '!')
        ->line('Uma agência deseja realizar o cadastro em nosso site. Abaixo seguem os dados:')
        ->line('**Nome:** ' . $this->request->nome)
        ->line('**Empresa:** ' . $this->request->empresa)
        ->line('**E-mail:** ' . $this->request->email)
        ->line('**Telefone:** ' . $this->request->telefone)
        ->line('**CNPJ:** ' . $this->request->cnpj)
        ->line('**Mensagem:** ' . $this->request->mensagem);
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
