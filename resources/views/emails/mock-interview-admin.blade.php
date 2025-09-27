<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Mock Interview Request</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0; padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1, h2, h3 { color: #667eea; }
        .info-box {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .info-label { font-weight: bold; }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
            border-top: 2px solid #f0f0f0;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>New Mock Interview Request</h1>
        <p>A new mock interview has been booked. Here are the details:</p>

        <div class="info-box">
            <p><span class="info-label">Name:</span> {{ $mockInterview->name }}</p>
            <p><span class="info-label">Email:</span> {{ $mockInterview->email }}</p>
            <p><span class="info-label">Date:</span> {{ $mockInterview->date }}</p>
            <p><span class="info-label">Time:</span> {{ $mockInterview->time }}</p>
            <p><span class="info-label">Experience:</span> {{ $mockInterview->experience }}</p>
            <p><span class="info-label">Technology:</span> {{ $mockInterview->technology }}</p>
            @if($mockInterview->notes)
                <p><span class="info-label">Notes:</span> {{ $mockInterview->notes }}</p>
            @endif
        </div>

        <div class="footer">
            <p>MeetMyTech Team</p>
            <p><a href="mailto:contact.us@meetmytech.com" style="color: #667eea;">contact.us@meetmytech.com</a> | <a href="{{ url('/') }}" style="color: #667eea;">{{ url('/') }}</a></p>
        </div>
    </div>
</body>
</html>
