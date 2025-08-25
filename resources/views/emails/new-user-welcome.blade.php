<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MeetMyTech</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        .logo {
            color: #667eea;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .brand-name {
            color: #667eea;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .welcome-text {
            color: #666;
            margin: 10px 0 0 0;
        }
        .content {
            margin: 20px 0;
        }
        .credentials-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .credentials-box h3 {
            margin: 0 0 15px 0;
            color: white;
        }
        .credential-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 6px;
            margin: 10px 0;
        }
        .credential-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .credential-value {
            font-family: 'Courier New', monospace;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 4px;
            word-break: break-all;
        }
        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .security-note {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <i class="fas fa-code"></i>
            </div>
            <h1 class="brand-name">MeetMyTech</h1>
            <p class="welcome-text">Professional Portfolio Platform</p>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2>Welcome {{ $user->name }}!</h2>

            <p>We're excited to have you join MeetMyTech! Your account has been successfully created by our administrator.</p>

            <p>You can now access your professional portfolio dashboard and start building your online presence.</p>

            <!-- Login Credentials -->
            <div class="credentials-box">
                <h3><i class="fas fa-key"></i> Your Login Credentials</h3>

                <div class="credential-item">
                    <span class="credential-label">Email Address:</span>
                    <div class="credential-value">{{ $user->email }}</div>
                </div>

                <div class="credential-item">
                    <span class="credential-label">Temporary Password:</span>
                    <div class="credential-value">{{ $password }}</div>
                </div>
            </div>

            <!-- Security Note -->
            <div class="security-note">
                <strong><i class="fas fa-shield-alt"></i> Security Notice:</strong>
                For your security, please change this temporary password after your first login. You can update your password from your profile settings.
            </div>

            <!-- Login Button -->
            <div style="text-align: center;">
                <a href="{{ url('/login') }}" class="login-button">
                    <i class="fas fa-sign-in-alt"></i> Login to Your Account
                </a>
            </div>

            <!-- Getting Started -->
            <h3>Getting Started</h3>
            <ul>
                <li><strong>Complete Your Profile:</strong> Add your personal information, skills, and experience</li>
                <li><strong>Upload Your Resume:</strong> Share your professional background</li>
                <li><strong>Customize Your Portfolio:</strong> Make it uniquely yours</li>
                <li><strong>Share Your Profile:</strong> Start networking with your unique MeetMyTech URL</li>
            </ul>

            <p>If you have any questions or need assistance, feel free to contact our support team.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>MeetMyTech Team</strong></p>
            <p>Professional Portfolio Platform</p>
            <p>
                <a href="mailto:admin@meetmytech.com" style="color: #667eea;">admin@meetmytech.com</a> |
                <a href="{{ url('/') }}" style="color: #667eea;">{{ url('/') }}</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px; color: #999;">
                This email was sent because an account was created for you on MeetMyTech.
                If you believe this was sent in error, please contact our support team.
            </p>
        </div>
    </div>
</body>
</html>
