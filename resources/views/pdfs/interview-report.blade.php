<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Interview Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.1;
            z-index: -1;
        }
        .watermark img {
            width: 400px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }
        .content {
            margin-left: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ $header }}" alt="MeetMyTech Logo">
        <h1>Mock Interview Report</h1>
    </div>

    <div class="watermark">
        <img src="{{ $watermark }}" alt="Watermark">
    </div>

    <div class="section">
        <div class="section-title">Candidate Information</div>
        <div class="content">
            <table>
                <tr>
                    <th>Name</th>
                    <td>{{ $interview->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $interview->email }}</td>
                </tr>
                <tr>
                    <th>Interview Date</th>
                    <td>{{ $interview->date }}</td>
                </tr>
                <tr>
                    <th>Interview Time</th>
                    <td>{{ $interview->time }}</td>
                </tr>
                <tr>
                    <th>Experience Level</th>
                    <td>{{ $interview->experience_level }}</td>
                </tr>
                <tr>
                    <th>Expected Role</th>
                    <td>{{ $interview->role }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Interview Assessment</div>
        <div class="content">
            <table>
                <tr>
                    <th style="width: 200px;">Category</th>
                    <th>Comments</th>
                </tr>
                <tr>
                    <td>Technical Skills</td>
                    <td>{{ $interview->admin_notes }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <p>Thank you for participating in the mock interview with MeetMyTech. We hope this feedback helps you in your career journey.</p>
        <p style="color: #666; font-style: italic;">This is a system-generated report. For any queries, please contact contact.us@meetmytech.com</p>
    </div>
</body>
</html>
