<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Blog Published - MeetMyTech</title>
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
            padding: 40px 30px;
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
        .blog-card {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border: 2px solid #667eea;
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
        }
        .blog-title {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 15px;
            line-height: 1.3;
        }
        .blog-meta {
            color: #718096;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .blog-excerpt {
            color: #4a5568;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .read-more-btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white !important;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .read-more-btn:hover {
            text-decoration: none;
            color: white;
            transform: translateY(-2px);
        }
        .author-info {
            background: #f7fafc;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
            border-left: 4px solid #667eea;
        }
        .email-footer {
            background: #1a202c;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .unsubscribe-section {
            background: #fff5f5;
            border: 1px solid #feb2b2;
            border-radius: 8px;
            padding: 15px;
            margin: 25px 0;
            text-align: center;
        }
        .unsubscribe-link {
            color: #e53e3e;
            text-decoration: none;
            font-weight: bold;
        }
        .unsubscribe-link:hover {
            text-decoration: underline;
        }
        .brand {
            color: #fbbf24;
            font-weight: bold;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 5px;
            }
            .email-header, .email-body {
                padding: 20px 15px;
            }
            .blog-card {
                padding: 15px;
            }
            .blog-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>📚 New Blog Published!</h1>
            <p class="subtitle">Fresh content from MeetMyTech is here</p>
        </div>

        <div class="email-body">
            <p>Hello there!</p>

            <p>We're excited to share that a new blog post has been published on MeetMyTech. Here's what's waiting for you:</p>

            <div class="blog-card">
                @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="blog-image">
                @endif

                <div class="blog-title">{{ $blog->title }}</div>

                <div class="blog-meta">
                    Published on {{ $blog->published_at->format('F j, Y') }}
                    @if($blog->reading_time)
                        • {{ $blog->reading_time }}
                    @endif
                    @if($blog->views_count)
                        • {{ number_format($blog->views_count) }} views
                    @endif
                </div>

                @if($blog->description)
                    <div class="blog-excerpt">
                        {{ Str::limit($blog->description, 200) }}
                    </div>
                @endif

                <div style="text-align: center;">
                    <a href="{{ $blogUrl }}" class="read-more-btn">
                        📖 Read Full Article
                    </a>
                </div>
            </div>

            @if($blog->user)
            <div class="author-info">
                <strong>👤 About the Author:</strong><br>
                <strong>{{ $blog->user->name }}</strong><br>
                @if($blog->user->email)
                    <a href="mailto:{{ $blog->user->email }}">{{ $blog->user->email }}</a>
                @endif
            </div>
            @endif

            <p>Don't miss out on this insightful content. Click the button above to read the full article and join the discussion!</p>

            <div class="unsubscribe-section">
                <p style="margin: 0; color: #718096; font-size: 14px;">
                    <strong>Not interested in blog notifications anymore?</strong><br>
                    <a href="{{ $unsubscribeUrl }}" class="unsubscribe-link">Click here to unsubscribe</a>
                </p>
            </div>
        </div>

        <div class="email-footer">
            <p><span class="brand">MeetMyTech</span> - Empowering Tech Professionals Worldwide</p>

            <div class="social-links">
                <a href="#">LinkedIn</a> |
                <a href="#">Twitter</a> |
                <a href="#">GitHub</a>
            </div>

            <p style="font-size: 12px; opacity: 0.8; margin: 15px 0 0 0;">
                This email was sent to {{ $subscriber->email }} because you subscribed to our blog notifications.<br>
                © {{ date('Y') }} MeetMyTech. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
