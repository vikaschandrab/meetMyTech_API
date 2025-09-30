<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; }
        .success { color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="success">Database Backup Successful</h2>
        <p>The daily database backup was completed successfully on {{ $date }}.</p>
        <p>The backup file is attached to this email.</p>
        <p>Best regards,<br>MeetMyTech System</p>
    </div>
</body>
</html>