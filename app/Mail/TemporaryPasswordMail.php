<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invent;

class TemporaryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invent;
    public $tempPassword;
    public $resetToken;

    public function __construct(Invent $invent, $tempPassword, $resetToken)
    {
        $this->invent = $invent;
        $this->tempPassword = $tempPassword;
        $this->resetToken = $resetToken;
    }

    public function build()
    {
        return $this->subject('KSG Innovations Portal - Temporary Password')
                    ->view('Invent.Mails.temporary-password')
                    ->with([
                        'invent' => $this->invent,
                        'tempPassword' => $this->tempPassword,
                        'resetToken' => $this->resetToken,
                    ]);
    }
}
