<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class registerMail extends Mailable
{
    use Queueable, SerializesModels;
    public $register;

    public function __construct($register)
    {

        $this->register = $register;
    }

    public function build()
    {
        return $this->from('anderson.souza0909@gmail.com',':D 4Events')
            ->subject('Registro efetuado com sucesso')
            ->view('emails.confirmationMail');
    }

}
