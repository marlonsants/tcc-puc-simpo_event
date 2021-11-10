<?php

namespace App\Mail;

use App\Administrator;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Administrator $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@4events.com.br','4Events')
            ->subject('Ativação de conta')
            ->markdown('emails.confirmAdminMail');
    }
}
