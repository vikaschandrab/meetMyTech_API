<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Interview Confirmation</title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: 20px auto; background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h1, h2 { color: #667eea; }
        .info-box { background: #e3f2fd; padding: 15px; border-radius: 8px; margin: 15px 0; }
        .info-label { font-weight: bold; }
        .button {
            display: inline-block;
            background: linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
        .footer { text-align: center; margin-top: 30px; font-size: 14px; color: #666; border-top: 2px solid #f0f0f0; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Hello {{ $mockInterview->name }},</h1>

        @if($status === 'accepted')
            <p>Your mock interview has been <strong>confirmed</strong>. Here are the details:</p>
        @elseif($status === 'rejected')
            <p>We are sorry to inform you that your mock interview request was <strong>rejected</strong>.</p>
        @elseif($status === 'completed')
            <p>Your mock interview has been completed. You can find your detailed assessment report attached to this email.</p>
        @elseif($status === 'completed_with_notes')
            <p>Your mock interview has been completed. You can find your detailed assessment report along with additional notes attached to this email.</p>
        @elseif($status === 'custom' && $customMessage)
            <p>{{ $customMessage }}</p>
        @else
            <p>Thank you for booking a mock interview with MeetMyTech. Here are your request details:</p>
        @endif

        <div class="info-box">
            <p>
                <span class="info-label">Date & Time:</span>
                {{ \Carbon\Carbon::parse($mockInterview->date)->format('Y-m-d') . ' ' . \Carbon\Carbon::parse($mockInterview->time)->format('H:i:s') }}
            </p>
            <p><span class="info-label">Technology:</span> {{ $mockInterview->technology }}</p>
            <p><span class="info-label">Experience:</span> {{ $mockInterview->experience }}</p>
            @if($mockInterview->notes)
                <p><span class="info-label">Notes:</span> {{ $mockInterview->notes }}</p>
            @endif
            @if($status === 'accepted' && $mockInterview->meeting_link)
                <p><span class="info-label">Meeting Link:</span> <a href="{{ $mockInterview->meeting_link }}">{{ $mockInterview->meeting_link }}</a></p>
            @endif

            @if(in_array($status, ['completed', 'completed_with_notes']) && isset($assessment))
                <p><span class="info-label">Overall Rating:</span> {{ $assessment['overall_rating'] ?? 'N/A' }}</p>
                @if(isset($assessment['feedback']))
                    <p><span class="info-label">Feedback:</span> {{ $assessment['feedback'] }}</p>
                @endif
                @if(isset($assessment['strengths']))
                    <p><span class="info-label">Strengths:</span></p>
                    <ul>
                        @foreach($assessment['strengths'] as $strength)
                            <li>{{ $strength }}</li>
                        @endforeach
                    </ul>
                @endif
                @if(isset($assessment['areas_for_improvement']))
                    <p><span class="info-label">Areas for Improvement:</span></p>
                    <ul>
                        @foreach($assessment['areas_for_improvement'] as $area)
                            <li>{{ $area }}</li>
                        @endforeach
                    </ul>
                @endif
            @endif
        </div>

        <a href="{{ url('/') }}" class="button">Visit MeetMyTech</a>

        <div class="footer">
            <p>MeetMyTech Team</p>
            <p><a href="mailto:contact.us@meetmytech.com" style="color: #667eea;">contact.us@meetmytech.com</a> | <a href="{{ url('/') }}" style="color: #667eea;">{{ url('/') }}</a></p>
        </div>
    </div>
</body>
</html>
