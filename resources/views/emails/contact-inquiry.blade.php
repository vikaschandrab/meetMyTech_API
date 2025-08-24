<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry - MeetMyTech</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .email-header .subtitle {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .email-body {
            padding: 30px;
        }
        .contact-info {
            background: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 5px 5px 0;
        }
        .info-row {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }
        .info-row:last-child {
            margin-bottom: 0;
        }
        .info-label {
            font-weight: bold;
            color: #2563eb;
            min-width: 140px;
            display: inline-block;
        }
        .info-value {
            flex: 1;
            word-break: break-word;
        }
        .technologies-box {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }
        .email-footer {
            background: #1f2937;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .timestamp {
            color: #6b7280;
            font-size: 13px;
            margin-top: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
        .brand {
            color: #f59e0b;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🚀 New Contact Inquiry</h1>
            <p class="subtitle">Someone is ready to start their tech journey!</p>
        </div>
        
        <div class="email-body">
            <p>Hello MeetMyTech Team,</p>
            
            <p>You have received a new contact inquiry from someone interested in joining the MeetMyTech platform. Here are the details:</p>
            
            <div class="contact-info">
                <div class="info-row">
                    <span class="info-label">👤 Name:</span>
                    <span class="info-value">{{ $contactData['first_name'] }} {{ $contactData['last_name'] }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">📧 Personal Email:</span>
                    <span class="info-value">{{ $contactData['personal_email'] }}</span>
                </div>
                
                @if(!empty($contactData['professional_email']))
                <div class="info-row">
                    <span class="info-label">💼 Professional Email:</span>
                    <span class="info-value">{{ $contactData['professional_email'] }}</span>
                </div>
                @endif
                
                <div class="info-row">
                    <span class="info-label">🏢 Organization:</span>
                    <span class="info-value">{{ $contactData['current_organization'] }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">🎯 Position:</span>
                    <span class="info-value">{{ $contactData['position'] }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">💻 Technologies:</span>
                    <div class="info-value">
                        <div class="technologies-box">
                            {{ $contactData['technologies'] }}
                        </div>
                    </div>
                </div>
            </div>
            
            <p><strong>Next Steps:</strong></p>
            <ul>
                <li>Review their technology background and experience level</li>
                <li>Respond within 24 hours with onboarding information</li>
                <li>Consider their tech stack for potential collaboration opportunities</li>
                <li>Add them to the appropriate email list for updates</li>
            </ul>
            
            <p>This inquiry was submitted through the "Start Your Journey" contact form on the MeetMyTech homepage.</p>
            
            <div class="timestamp">
                Submitted on {{ date('F j, Y \a\t g:i A T') }}
            </div>
        </div>
        
        <div class="email-footer">
            <p><span class="brand">MeetMyTech</span> - Empowering Tech Professionals Worldwide</p>
            <p style="margin: 5px 0 0 0; opacity: 0.8;">This email was automatically generated from the contact form.</p>
        </div>
    </div>
</body>
</html>
