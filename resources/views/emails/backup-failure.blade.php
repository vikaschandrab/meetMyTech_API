<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; }
        .error { color: #dc3545; }
        .error-details {
            background: #f8d7da;
            padding: 15px;
            border-radius: 4px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="error">Database Backup Failed</h2>
        <p>The daily database backup failed on {{ $date }}.</p>
        <div class="error-details">
            <h3>Error Details:</h3>
            <pre>{{ $error }}</pre>
        </div>
        <p>A detailed PDF report is attached to this email.</p>
        <p>Please investigate this issue as soon as possible.</p>
        <p>Best regards,<br>MeetMyTech System</p>
    </div>
</body>
</html>
