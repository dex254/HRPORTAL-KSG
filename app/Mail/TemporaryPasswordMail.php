<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemporaryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tempPassword;
    public $resetToken;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $tempPassword, $resetToken)
    {
        $this->user = $user;
        $this->tempPassword = $tempPassword;
        $this->resetToken = $resetToken;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('KSG  HR Portal - Temporary Password')
                    ->view('emails.temporary_password');
    }
}

