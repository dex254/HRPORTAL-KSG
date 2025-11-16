<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $plainPassword;

    public function __construct(Admin $admin, $plainPassword)
    {
        $this->admin = $admin;
        $this->plainPassword = $plainPassword;
    }

    public function build()
    {
        return $this->subject('Your Admin Account Has Been Created')
                    ->view('emails.admin_welcome');
    }
}
