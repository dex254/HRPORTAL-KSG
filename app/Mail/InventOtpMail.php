<?php

namespace App\Mail;

use App\Models\Invent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InventOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invent;
    public $otp;

    public function __construct(Invent $invent, $otp)
    {
        $this->invent = $invent;
        $this->otp = $otp;
    }

    public function build()
    {
        $verifyUrl = route('invent.otp.verify.page', ['email' => $this->invent->email]);

        return $this->subject('Your OTP Verification Code')
            ->view('emails.invent_otp')
            ->with([
                'invent' => $this->invent,
                'otp' => $this->otp,
                'verifyUrl' => $verifyUrl,
            ]);
    }
}