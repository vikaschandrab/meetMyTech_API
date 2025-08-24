<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MeetMyTech - Your Journey Begins!</title>
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
            font-size: 18px;
        }
        .email-body {
            padding: 40px 30px;
        }
        .welcome-message {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-left: 4px solid #2563eb;
            padding: 25px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        .next-steps {
            background: #f8fafc;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }
        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .step:last-child {
            margin-bottom: 0;
        }
        .step-number {
            background: #2563eb;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
            font-size: 14px;
        }
        .step-content h4 {
            margin: 0 0 5px 0;
            color: #1f2937;
            font-size: 16px;
        }
        .step-content p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            text-decoration: none;
            color: white;
        }
        .features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 25px 0;
        }
        .feature {
            text-align: center;
            padding: 20px;
            background: #f8fafc;
            border-radius: 8px;
        }
        .feature-icon {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .feature h5 {
            margin: 0 0 8px 0;
            color: #1f2937;
            font-size: 14px;
        }
        .feature p {
            margin: 0;
            color: #6b7280;
            font-size: 12px;
        }
        .contact-info {
            background: #fef3c7;
            border: 1px solid #fbbf24;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .email-footer {
            background: #1f2937;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .brand {
            color: #f59e0b;
            font-weight: bold;
        }
        .social-links {
            margin: 15px 0;
        }
        .social-links a {
            color: #9ca3af;
            text-decoration: none;
            margin: 0 10px;
            font-size: 18px;
        }
        @media (max-width: 600px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
            .email-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🎉 Welcome to MeetMyTech!</h1>
            <p class="subtitle">Your tech journey starts here, {{ $contactData['first_name'] }}!</p>
        </div>
        
        <div class="email-body">
            <p>Hi {{ $contactData['first_name'] }},</p>
            
            <p>Thank you for reaching out to MeetMyTech! We're thrilled that you're interested in showcasing your tech expertise and joining our vibrant community of professionals.</p>
            
            <div class="welcome-message">
                <h3 style="margin-top: 0; color: #2563eb;">🚀 Your Information Has Been Received</h3>
                <p style="margin-bottom: 0;">We've received your details and our team is excited to help you get started. Based on your background in <strong>{{ $contactData['technologies'] }}</strong> at <strong>{{ $contactData['current_organization'] }}</strong>, we can see great potential for your MeetMyTech profile!</p>
            </div>
            
            <div class="next-steps">
                <h3 style="margin-top: 0; color: #1f2937;">📋 What Happens Next?</h3>
                
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Review & Setup (Next 24 Hours)</h4>
                        <p>Our team will review your profile and send you personalized onboarding instructions.</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>Account Creation (2-3 Days)</h4>
                        <p>We'll help you set up your professional profile and portfolio showcase.</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Content Strategy (Week 1)</h4>
                        <p>Get guidance on creating compelling tech content and building your audience.</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4>Community Integration (Ongoing)</h4>
                        <p>Connect with like-minded professionals and start sharing your expertise.</p>
                    </div>
                </div>
            </div>
            
            <div class="features-grid">
                <div class="feature">
                    <div class="feature-icon">💼</div>
                    <h5>Professional Portfolio</h5>
                    <p>Showcase your projects and skills</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">✍️</div>
                    <h5>Tech Blogging</h5>
                    <p>Share your knowledge and insights</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🤝</div>
                    <h5>Community Network</h5>
                    <p>Connect with industry professionals</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">📈</div>
                    <h5>Career Growth</h5>
                    <p>Build your professional brand</p>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="https://meetmytech.com" class="cta-button">
                    🌟 Explore MeetMyTech Platform
                </a>
            </div>
            
            <div class="contact-info">
                <h4 style="margin-top: 0; color: #92400e;">💬 Questions or Need Help?</h4>
                <p style="margin-bottom: 10px;">Our team is here to support you every step of the way!</p>
                <p style="margin-bottom: 0;"><strong>Email:</strong> contact.us@meetmytech.com</p>
            </div>
            
            <p>We're excited to have you join our community of passionate tech professionals. Your expertise in {{ $contactData['technologies'] }} will be a valuable addition to our platform!</p>
            
            <p>Welcome aboard! 🎯</p>
            
            <p style="margin-bottom: 0;">
                Best regards,<br>
                <strong>The MeetMyTech Team</strong>
            </p>
        </div>
        
        <div class="email-footer">
            <p><span class="brand">MeetMyTech</span> - Empowering Tech Professionals Worldwide</p>
            
            <div class="social-links">
                <a href="#" title="LinkedIn">💼</a>
                <a href="#" title="Twitter">🐦</a>
                <a href="#" title="GitHub">💻</a>
                <a href="#" title="Website">🌐</a>
            </div>
            
            <p style="font-size: 12px; opacity: 0.8; margin: 15px 0 0 0;">
                This email was sent to {{ $contactData['personal_email'] }} because you submitted a contact form on MeetMyTech.<br>
                © {{ date('Y') }} MeetMyTech. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
