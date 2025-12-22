<?php


namespace App\Mail;

use App\Models\HRPU;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HrpuWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hrpu;

    public function __construct(HRPU $hrpu)
    {
        $this->hrpu = $hrpu;
    }

    public function build()
    {
        return $this->subject('Welcome to Career Portal - Your Security Key')
                    ->view('emails.hrpu_welcome');
    }
}
