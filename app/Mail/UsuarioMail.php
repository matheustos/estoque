<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsuarioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $newPassword;

    public function __construct($usuario, $newPassword)
    {
        $this->usuario = $usuario;
        $this->newPassword = $newPassword;
    }

    public function build()
    {
        return $this->subject('Nova Senha de Acesso')
                    ->view('emails.usuario');
    }
}
