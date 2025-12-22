<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicationData;
    public $pdfPath;

    public function __construct($applicationData, $pdfPath)
    {
        $this->applicationData = $applicationData;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Job Application Confirmation')
            ->view('emails.user_report')
            ->with('applicationData', $this->applicationData)
            ->attach($this->pdfPath, [
                'as' => 'User_Report.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
