<?php

namespace App\Mail;

use App\Models\MockInterview;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MockInterviewAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mockInterview;

    public function __construct(MockInterview $mockInterview)
    {
        $this->mockInterview = $mockInterview;
    }

    public function build()
    {
        return $this->subject('New Mock Interview Request')
            ->markdown('emails.mock-interview-admin');
    }
}
