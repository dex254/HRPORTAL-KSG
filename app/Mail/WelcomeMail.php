<?php

namespace App\Mail;

use App\Models\Invent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invent;

    /**
     * Create a new message instance.
     */
    public function __construct(Invent $invent)
    {
        $this->invent = $invent;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('🎉 Welcome to the Innovation Challenge')
                    ->view('emails.welcome')
                    ->with([
                        'email' => $this->invent->email,
                        'securityKey' => $this->invent->securitykey,
                    ]);
    }
}
