<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your New Password - MeetMyTech</title>
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
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .email-header .subtitle {
            margin: 15px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .email-body {
            padding: 40px 30px;
        }
        .password-box {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border: 2px solid #667eea;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            margin: 25px 0;
        }
        .password-text {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            display: inline-block;
            margin: 10px 0;
        }
        .warning-box {
            background: #fef3c7;
            border: 1px solid #fbbf24;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .warning-box h4 {
            color: #92400e;
            margin-top: 0;
        }
        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .login-button:hover {
            text-decoration: none;
            color: white;
        }
        .steps-list {
            background: #f8fafc;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }
        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        .step:last-child {
            margin-bottom: 0;
        }
        .step-number {
            background: #667eea;
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
            font-size: 12px;
        }
        .step-content {
            flex: 1;
        }
        .email-footer {
            background: #1f2937;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .brand {
            color: #fbbf24;
            font-weight: bold;
        }
        .security-notice {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🔑 Password Reset</h1>
            <p class="subtitle">Your new MeetMyTech password is ready!</p>
        </div>
        
        <div class="email-body">
            <p>Hello {{ $user->name }},</p>
            
            <p>We received a request to reset your password for your MeetMyTech account. As requested, we've generated a new secure password for you.</p>
            
            <div class="password-box">
                <h3 style="margin-top: 0; color: #667eea;">🔐 Your New Password</h3>
                <div class="password-text">{{ $newPassword }}</div>
                <p style="margin-bottom: 0; color: #6b7280; font-size: 14px;">
                    <strong>Important:</strong> Copy this password exactly as shown (case-sensitive)
                </p>
            </div>
            
            <div class="warning-box">
                <h4>⚠️ Security Reminder</h4>
                <ul style="margin-bottom: 0; padding-left: 20px;">
                    <li>This password was auto-generated for security</li>
                    <li>Please change it immediately after logging in</li>
                    <li>Never share your password with anyone</li>
                    <li>This email contains sensitive information - delete it after use</li>
                </ul>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="login-button">
                    🚀 Login to MeetMyTech
                </a>
            </div>
            
            <div class="steps-list">
                <h4 style="margin-top: 0; color: #1f2937;">📋 Next Steps:</h4>
                
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <strong>Login with new password</strong><br>
                        <small>Use your email and the password above to sign in</small>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <strong>Change your password</strong><br>
                        <small>Go to Profile Settings → Change Password</small>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <strong>Delete this email</strong><br>
                        <small>For security, delete this email after use</small>
                    </div>
                </div>
            </div>
            
            <div class="security-notice">
                <p style="margin: 0; color: #dc2626; font-weight: bold;">
                    🛡️ If you didn't request this password reset, please contact us immediately at admin@meetmytech.com
                </p>
            </div>
            
            <p><strong>Account Details:</strong></p>
            <ul>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Request Time:</strong> {{ date('F j, Y \a\t g:i A T') }}</li>
                <li><strong>Login URL:</strong> <a href="{{ $loginUrl }}">{{ $loginUrl }}</a></li>
            </ul>
            
            <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
            
            <p style="margin-bottom: 0;">
                Best regards,<br>
                <strong>MeetMyTech Support Team</strong>
            </p>
        </div>
        
        <div class="email-footer">
            <p><span class="brand">MeetMyTech</span> - Empowering Tech Professionals Worldwide</p>
            
            <p style="font-size: 12px; opacity: 0.8; margin: 15px 0 0 0;">
                This email was sent to {{ $user->email }} because you requested a password reset.<br>
                © {{ date('Y') }} MeetMyTech. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
