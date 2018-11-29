<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Jogador\Mensalidade as MensalidadeModel;

class Mensalidade extends Mailable
{
    use Queueable, SerializesModels;

    private $mensalidade;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MensalidadeModel $mensalidade)
    {
        $this->mensalidade = $mensalidade;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mensalidade');
    }
}
