<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { border-bottom: 2px solid #dc3545; padding-bottom: 10px; margin-bottom: 20px; }
        .error-details { 
            background: #f8d7da; 
            padding: 15px; 
            border-radius: 4px; 
            margin: 15px 0;
            white-space: pre-wrap;
        }
        .timestamp {
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Database Backup Failure Report</h1>
        <div class="timestamp">Generated on: {{ $date }}</div>
    </div>

    <h2>Error Details</h2>
    <div class="error-details">
        {{ $error }}
    </div>

    <div style="margin-top: 30px;">
        <p><strong>System Information:</strong></p>
        <ul>
            <li>Environment: {{ config('app.env') }}</li>
            <li>PHP Version: {{ phpversion() }}</li>
            <li>Laravel Version: {{ app()->version() }}</li>
        </ul>
    </div>
</body>
</html>