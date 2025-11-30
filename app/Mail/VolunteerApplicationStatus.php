<?php

namespace App\Mail;

use App\Models\VolunteerApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VolunteerApplicationStatus extends Mailable
{
    use Queueable, SerializesModels;

    public VolunteerApplication $application;
    public string $status;

    /**
     * Create a new message instance.
     */
    public function __construct(VolunteerApplication $application, string $status)
    {
        $this->application = $application;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        $subject = $this->status === 'approved' 
            ? 'Congratulations! Your Volunteer Application Has Been Approved' 
            : 'Update on Your Volunteer Application';

        return $this->subject($subject)
                    ->view('mails.volunteer-application-status')
                    ->with([
                        'application' => $this->application,
                        'status' => $this->status,
                        'isApproved' => $this->status === 'approved',
                    ]);
    }
}
