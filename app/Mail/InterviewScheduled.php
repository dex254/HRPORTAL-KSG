<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $idnumber;
    public $name;
    public $refNo;
    public $designation;
    public $interviewDate;
    public $venue;
    public $status;
    public $filePath;

    public function __construct($idnumber, $name, $refNo, $designation, $interviewDate, $venue, $status, $filePath)
    {
        $this->idnumber = $idnumber;
        $this->name = $name;
        $this->refNo = $refNo;
        $this->designation = $designation;
        $this->interviewDate = $interviewDate;
        $this->venue = $venue;
        $this->status = $status;
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject('Interview Scheduled - KSG Application')
                    ->view('emails.interview_scheduled')
                    ->attach($this->filePath, [
                        'as' => 'Interview_Memo.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}