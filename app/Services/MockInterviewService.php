<?php
namespace App\Services;

use App\Models\MockInterview;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MockInterviewAdminMail;
use App\Mail\MockInterviewAcknowledgmentMail;

class MockInterviewService
{
    public function handle(array $data)
    {
        // 1. Store in DB
        $mockInterview = MockInterview::create($data);

        // 2. Send mail to admin
        Mail::to('contact.us@meetmytech.com')->send(new MockInterviewAdminMail($mockInterview));

        // 3. Send acknowledgment to user
        Mail::to($data['email'])->send(new MockInterviewAcknowledgmentMail($mockInterview));

        // 4. Log activity
        Log::info('Mock interview booked', $data);
    }
}
