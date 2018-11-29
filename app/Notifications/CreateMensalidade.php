<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Jogador\Mensalidade as MensalidadeModel;

class CreateMensalidade extends Notification
{
    use Queueable;

    private $mensalidade;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MensalidadeModel $mensalidade)
    {
        $this->mensalidade = $mensalidade;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject('Nova Mensalidade Gerada')
                    ->line('Uma nova Mensalidade gerada.')
                    ->action('Acessar Aplicação', url(config('app.url')));
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

    public function toDatabase($notifiable)
    {
        return [
            'mensagem' => 'Mensalidade Gerada com sucesso'
        ];
    }
}
