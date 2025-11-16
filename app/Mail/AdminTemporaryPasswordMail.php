<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Admin;

class AdminTemporaryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $tempPassword;
    public $resetToken;

    public function __construct(Admin $admin, $tempPassword, $resetToken)
    {
        $this->admin = $admin;
        $this->tempPassword = $tempPassword;
        $this->resetToken = $resetToken;
    }

    public function build()
    {
        return $this->subject('KSG Admin Portal - Temporary Password')
            ->view('Admin.Mails.temporary-password')
            ->with([
                'admin' => $this->admin,
                'tempPassword' => $this->tempPassword,
                'resetToken' => $this->resetToken,
            ]);
    }
}
