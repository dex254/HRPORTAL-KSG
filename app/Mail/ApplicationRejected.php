<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $idnumber;
    public $name;
    public $refNo;
    public $designation;
    public $status;
    public $rejectionReason;
    public $filePath;

    public function __construct($idnumber, $name, $refNo, $designation, $status, $rejectionReason, $filePath)
    {
        $this->idnumber = $idnumber;
        $this->name = $name;
        $this->refNo = $refNo;
        $this->designation = $designation;
        $this->status = $status;
        $this->rejectionReason = $rejectionReason;
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject('Application Status Update - Kenya School of Government (KSG)')
                    ->view('emails.application_rejected')
                    ->attach($this->filePath, [
                        'as' => 'Application_Status_Update.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}