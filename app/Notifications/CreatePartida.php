<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Partida;

class CreatePartida extends Notification
{
    use Queueable;

    private $partida;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Partida $partida)
    {
        $this->partida = $partida;
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
                    ->subject('Nova Partida')
                    ->line('Nova Partida marcada para o dia ' . $this->partida->inicio->format('d/m/Y') . ' às ' . $this->partida->inicio->format('H:i'))

                    ->line('Quadra: ' . $this->partida->quadra->nome)

                    ->action('Notification Action', url('/'))
                    ->action('Acessar Site', url(config('app.url')));
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
            'mensagem' => 'Partida marcada com sucesso'
        ];
    }
}
