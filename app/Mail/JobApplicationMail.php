<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $cvPath;
    public $coverLetterPath;
    public $bioPdfPath;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string $cvPath
     * @param string $coverLetterPath
     * @param string $bioPdfPath
     */
    public function __construct($data, $cvPath, $coverLetterPath, $bioPdfPath)
    {
        $this->data = $data;
        $this->cvPath = $cvPath;
        $this->coverLetterPath = $coverLetterPath;
        $this->bioPdfPath = $bioPdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('Job Application: ' . $this->data['designation'])
                      ->view('emails.job_application') // This references a Blade template
                      ->with([
                          'name' => $this->data['name'],
                          'designation' => $this->data['designation'],
                          'email' => $this->data['email'],
                          'phone' => $this->data['phone'],
                          'idnumber' => $this->data['idnumber'],
                          'Ref_No' => $this->data['Ref_No'],
                      ]);

        // Attach CV
        if (file_exists($this->cvPath)) {
            $email->attach($this->cvPath, [
                'as' => 'CV_' . $this->data['name'] . '.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        // Attach Cover Letter
        if (file_exists($this->coverLetterPath)) {
            $email->attach($this->coverLetterPath, [
                'as' => 'Cover_Letter_' . $this->data['name'] . '.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        // Attach Bio Report
        if (file_exists($this->bioPdfPath)) {
            $email->attach($this->bioPdfPath, [
                'as' => 'Bio_Report_' . $this->data['name'] . '.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $email;
    }
}
