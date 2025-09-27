<?php

namespace App\Mail;

use App\Models\MockInterview;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MockInterviewAcknowledgmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mockInterview;

    public function __construct(MockInterview $mockInterview)
    {
        $this->mockInterview = $mockInterview;
    }

    public function build()
    {
        return $this->subject('Mock Interview Request Received')
            ->markdown('emails.mock-interview-user');
    }
}
