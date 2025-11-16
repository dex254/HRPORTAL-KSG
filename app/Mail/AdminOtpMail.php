<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $otp;

    public function __construct(Admin $admin, $otp)
    {
        $this->admin = $admin;
        $this->otp = $otp;
    }

    public function build()
    {
        $quickVerifyUrl = route('Admin.otp.quick.verify', [
            'email' => $this->admin->email,
            'otp' => $this->otp
        ]);

        return $this->subject('Your Admin OTP Verification Code')
            ->view('emails.admin_otp')
            ->with([
                'admin' => $this->admin,
                'otp' => $this->otp,
                'quickVerifyUrl' => $quickVerifyUrl,
            ]);
    }
}
