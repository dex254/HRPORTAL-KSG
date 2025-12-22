<?php


namespace App\Mail;

use App\Models\EXT;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EXTWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ext;

    public function __construct(EXT $ext)
    {
        $this->ext = $ext;
    }

    public function build()
    {
        return $this->subject('Welcome to Career Portal - Your Security Key')
                    ->view('emails.Ext_welcome');
    }
}
