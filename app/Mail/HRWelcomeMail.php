<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HRWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hr; // Pass the entire HR object for flexibility

    /**
     * Create a new message instance.
     *
     * @param \App\Models\HR $hr
     */
    public function __construct($hr)
    {
        $this->hr = $hr; // Assign the HR model instance
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to KSG Career Portal')
                    ->view('emails.hr_welcome') // Your Blade view
                    ->with([
                        'name' => $this->hr->name,
                        'upn_no' => $this->hr->upn_no,
                    ]);
    }
}
