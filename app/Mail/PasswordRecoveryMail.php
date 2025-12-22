<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordRecoveryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hr;
    public $otp;
    public $verifyUrl;

    /**
     * @param \App\Models\HR $hr
     * @param string $otp
     */
    public function __construct($hr, string $otp)
    {
        $this->hr = $hr;
        $this->otp = $otp;

        // Auto verification link
        $this->verifyUrl = route('HR.autoVerify', [
            'upn_no' => $hr->upn_no,
            'otp'    => $otp
        ]);
    }

    public function build()
    {
        return $this->subject('KSG Career Portal – Temporary Login Password')
                    ->view('emails.password_recovery')
                    ->with([
                        'hr'        => $this->hr,
                        'otp'       => $this->otp,
                        'verifyUrl' => $this->verifyUrl
                    ]);
    }
}
