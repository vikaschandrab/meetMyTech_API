<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MockInterview;

class MeetingInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mockInterview;
    public $customMessage;
    public $status; // accepted, rejected, custom, completed, completed_with_notes, slot_unavailable, accepted_pending
    public $pdfContent;
    public $assessment;

    /**
     * Create a new message instance.
     */
    public function __construct(MockInterview $mockInterview, string $status = 'pending', string $customMessage = null, $pdfContent = null, array $assessment = null)
    {
        $this->mockInterview = $mockInterview;
        $this->status = $status;
        $this->customMessage = $customMessage;
        $this->pdfContent = $pdfContent;
        $this->assessment = $assessment;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = 'Mock Interview Update';

        switch ($this->status) {
            case 'accepted':
            case 'accepted_pending':
                $subject = 'Your Mock Interview is Confirmed';
                break;
            case 'rejected':
                $subject = 'Your Mock Interview Request was Rejected';
                break;
            case 'completed':
            case 'completed_with_notes':
                $subject = 'Your Mock Interview Assessment Report';
                break;
            case 'slot_unavailable':
                $subject = 'Mock Interview Slot Unavailable';
                break;
            case 'custom':
                $subject = 'Message Regarding Your Mock Interview';
                break;
        }

        $mail = $this->subject($subject)
            ->view('emails.meetingInvitation')
            ->with([
                'mockInterview' => $this->mockInterview,
                'customMessage' => $this->customMessage,
                'status'       => $this->status,
                'assessment'   => $this->assessment,
            ]);

        if ($this->pdfContent && in_array($this->status, ['completed', 'completed_with_notes'])) {
            $filename = $this->status === 'completed_with_notes' ? 'interview_assessment_with_notes.pdf' : 'interview_assessment.pdf';
            $mail->attachData($this->pdfContent, $filename, [
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }
}
