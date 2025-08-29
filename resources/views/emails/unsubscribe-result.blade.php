<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsubscribe Status - MeetMyTech</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
        .success {
            color: #48bb78;
        }
        .error {
            color: #f56565;
        }
        .message {
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .email-display {
            background: #f7fafc;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: bold;
            color: #2d3748;
        }
        .home-link {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 20px;
        }
        .home-link:hover {
            text-decoration: none;
            color: white;
        }
        .footer {
            background: #1a202c;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .brand {
            color: #fbbf24;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Unsubscribe Status</h1>
        </div>

        <div class="content">
            @if($success)
                <div class="icon success">✅</div>
                <div class="message">{{ $message }}</div>
                @if(isset($email))
                    <div class="email-display">{{ $email }}</div>
                @endif
                <p>You will no longer receive blog notification emails from us.</p>
                <p>If you change your mind, you can always resubscribe by visiting any blog post on our website.</p>
            @else
                <div class="icon error">❌</div>
                <div class="message">{{ $message }}</div>
                <p>If you continue to have issues, please contact our support team.</p>
            @endif

            <a href="{{ url('/') }}" class="home-link">
                🏠 Back to MeetMyTech
            </a>
        </div>

        <div class="footer">
            <p><span class="brand">MeetMyTech</span> - Empowering Tech Professionals Worldwide</p>
            <p>© {{ date('Y') }} MeetMyTech. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
