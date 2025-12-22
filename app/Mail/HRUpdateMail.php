<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HRUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hr;

    /**
     * Create a new message instance.
     *
     * @param $hr
     */
    public function __construct($hr)
    {
        $this->hr = $hr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your HR Record Has Been Updated')
                    ->view('emails.hr_update');
    }
}
