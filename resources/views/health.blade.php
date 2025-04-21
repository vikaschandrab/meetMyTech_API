<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Server Health Check</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 2rem;
        }
        .card {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Server Health</h2>
        <p><strong>CPU Load:</strong> {{ $cpuLoad }}</p>
        <p><strong>Memory Usage:</strong> {{ $memoryUsage }}</p>
        <p><strong>Memory Limit:</strong> {{ $memoryLimit }}</p>
    </div>
</body>
</html>
