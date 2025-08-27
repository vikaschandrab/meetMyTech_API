<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} - MeetMyTech</title>
    <meta name="description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">
    <meta name="keywords" content="{{ $blog->meta_keywords ?? implode(',', $blog->tags ?? []) }}">

    {{-- Open Graph meta tags --}}
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">

    {{-- Twitter Card meta tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog->title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('meetmytech_favicon.jpg') }}" type="image/jpeg">
    <link rel="shortcut icon" href="{{ asset('meetmytech_favicon.jpg') }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Prism.js for Code Highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">

    <style>
        :root {
            /* Futuristic Color Palette */
            --bg-primary: #0a0a0f;
            --bg-secondary: #161628;
            --bg-tertiary: #1e1e3a;
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.15);
            --text-primary: #ffffff;
            --text-secondary: #b8c2f0;
            --text-muted: #6b7ab8;

            /* Holographic Gradients */
            --holo-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --holo-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --holo-tertiary: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --holo-quaternary: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --holo-rainbow: linear-gradient(90deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);

            /* Neon Effects */
            --neon-blue: #00d4ff;
            --neon-purple: #b794f6;
            --neon-pink: #ff6b9d;
            --neon-green: #4fd1c7;
            --neon-yellow: #ffd700;

            /* Shadows and Glows */
            --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            --neon-glow: 0 0 30px;
            --soft-glow: 0 0 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.7;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animated Background with Floating Particles */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(102, 126, 234, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(183, 148, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(79, 209, 197, 0.1) 0%, transparent 50%),
                linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
            z-index: -2;
            animation: backgroundShift 15s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(2px 2px at 20px 30px, rgba(255, 255, 255, 0.1), transparent),
                radial-gradient(2px 2px at 40px 70px, rgba(102, 126, 234, 0.2), transparent),
                radial-gradient(1px 1px at 90px 40px, rgba(183, 148, 246, 0.3), transparent),
                radial-gradient(1px 1px at 130px 80px, rgba(79, 209, 197, 0.2), transparent);
            background-repeat: repeat;
            background-size: 200px 100px;
            z-index: -1;
            animation: particles 20s linear infinite;
        }

        @keyframes backgroundShift {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.02); }
        }

        @keyframes particles {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-200px, -100px); }
        }

        /* Glass Morphism Base */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
        }

        /* Header Styles */
        .blog-header {
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-tertiary) 100%);
            padding: 80px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .blog-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: var(--holo-rainbow);
            opacity: 0.1;
            animation: holographicRotate 20s linear infinite;
            z-index: 1;
        }

        @keyframes holographicRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .blog-header .container {
            position: relative;
            z-index: 2;
        }

        /* Navigation */
        .back-nav {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 12px 24px;
            color: var(--text-primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .back-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--holo-tertiary);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .back-nav:hover::before {
            left: 0;
        }

        .back-nav:hover {
            color: white;
            transform: translateX(-5px);
            box-shadow: var(--soft-glow) var(--neon-blue);
        }

        /* Blog Title */
        .blog-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: var(--holo-primary);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: var(--neon-glow) var(--neon-blue);
            animation: textGlow 3s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            0% { filter: brightness(1) saturate(1); }
            100% { filter: brightness(1.2) saturate(1.3); }
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 1rem;
            font-size: 1rem;
            color: var(--text-secondary);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--holo-quaternary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            box-shadow: var(--soft-glow) var(--neon-green);
            animation: avatarPulse 2s ease-in-out infinite;
        }

        @keyframes avatarPulse {
            0%, 100% { box-shadow: var(--soft-glow) var(--neon-green); }
            50% { box-shadow: 0 0 25px var(--neon-green); }
        }

        .blog-description {
            font-size: 1.25rem;
            color: var(--text-secondary);
            max-width: 800px;
            margin-top: 1rem;
        }

        /* Content Area */
        .content-area {
            padding: 80px 0;
            background: var(--bg-primary);
        }

        .content-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .blog-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: var(--text-primary);
            border-radius: 24px;
            padding: 2rem;
            position: relative;
        }

        .blog-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--holo-primary);
            opacity: 0.03;
            border-radius: 24px;
            animation: shimmer 4s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }

        .blog-content > * {
            position: relative;
            z-index: 2;
        }

        .blog-content h1,
        .blog-content h2,
        .blog-content h3,
        .blog-content h4,
        .blog-content h5,
        .blog-content h6 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            margin: 2rem 0 1rem 0;
            background: var(--holo-tertiary);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: var(--soft-glow) var(--neon-blue);
        }

        .blog-content h1 { font-size: 2.5rem; }
        .blog-content h2 { font-size: 2rem; }
        .blog-content h3 { font-size: 1.75rem; }
        .blog-content h4 { font-size: 1.5rem; }
        .blog-content h5 { font-size: 1.25rem; }
        .blog-content h6 { font-size: 1.125rem; }

        .blog-content p {
            margin-bottom: 1.5rem;
            color: var(--text-secondary);
        }

        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 16px;
            margin: 2rem 0;
            box-shadow: var(--glass-shadow);
            border: 1px solid var(--glass-border);
        }

        .blog-content blockquote {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-left: 4px solid transparent;
            border-image: var(--holo-tertiary) 1;
            padding: 1.5rem 2rem;
            margin: 2rem 0;
            border-radius: 12px;
            font-style: italic;
            font-size: 1.1rem;
            color: var(--text-secondary);
            position: relative;
            overflow: hidden;
        }

        .blog-content blockquote::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--holo-tertiary);
        }

        .blog-content code {
            background: var(--glass-bg);
            color: var(--neon-blue);
            padding: 4px 8px;
            border-radius: 8px;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 0.9em;
            border: 1px solid var(--glass-border);
        }

        .blog-content pre {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            color: var(--text-primary);
            padding: 1.5rem;
            border-radius: 16px;
            margin: 2rem 0;
            overflow-x: auto;
            line-height: 1.6;
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            position: relative;
        }

        .blog-content pre::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--holo-primary);
            opacity: 0.02;
            border-radius: 16px;
        }

        .blog-content pre code {
            background: none;
            padding: 0;
            color: inherit;
            border: none;
        }

        .blog-content ul,
        .blog-content ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
            color: var(--text-secondary);
        }

        .blog-content li {
            margin-bottom: 0.5rem;
        }

        .blog-content a {
            background: var(--holo-tertiary);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: underline;
            transition: all 0.3s ease;
        }

        .blog-content a:hover {
            text-shadow: var(--soft-glow) var(--neon-blue);
        }

        .blog-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
            border-radius: 12px;
            overflow: hidden;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }

        .blog-content th,
        .blog-content td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid var(--glass-border);
            color: var(--text-secondary);
        }

        .blog-content th {
            background: rgba(255, 255, 255, 0.05);
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Tags */
        .blog-tags {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--glass-border);
        }

        .tag {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            color: var(--text-primary);
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            margin: 4px 8px 4px 0;
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .tag::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--holo-quaternary);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .tag:hover::before {
            left: 0;
        }

        .tag:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--soft-glow) var(--neon-green);
        }

        /* Author Section */
        .author-section {
            background: var(--bg-secondary);
            padding: 60px 0;
            margin-top: 4rem;
        }

        .author-card {
            border-radius: 24px;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .author-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--holo-primary);
            opacity: 0.05;
            border-radius: 24px;
            animation: shimmer 3s ease-in-out infinite;
        }

        .author-card > * {
            position: relative;
            z-index: 2;
        }

        .author-card .author-avatar {
            width: 80px;
            height: 80px;
            font-size: 2rem;
            margin: 0 auto 1rem auto;
            box-shadow: var(--soft-glow) var(--neon-green);
        }

        .author-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .author-bio {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        .btn-outline-primary {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 2px solid var(--glass-border);
            color: var(--text-primary);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-outline-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--holo-tertiary);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-outline-primary:hover::before {
            left: 0;
        }

        .btn-outline-primary:hover {
            color: white;
            box-shadow: var(--soft-glow) var(--neon-blue);
        }

        /* Reading Progress */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: var(--holo-rainbow);
            z-index: 9999;
            transition: width 0.3s ease;
            box-shadow: var(--soft-glow) var(--neon-blue);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .blog-title {
                font-size: 2.25rem;
            }

            .blog-header {
                padding: 60px 0 40px;
            }

            .content-area {
                padding: 60px 0;
            }

            .blog-content {
                font-size: 1rem;
                padding: 1.5rem;
            }

            .blog-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 576px) {
            .blog-title {
                font-size: 1.875rem;
            }

            .blog-description {
                font-size: 1.125rem;
            }

            .content-wrapper {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="reading-progress"></div>

    <!-- Blog Header -->
    <header class="blog-header">
        <div class="container">
            <a href="{{ route('home.all-blogs') }}" class="back-nav" data-aos="fade-right">
                <i class="fas fa-arrow-left"></i>
                Back to All Articles
            </a>

            <h1 class="blog-title" data-aos="fade-up" data-aos-delay="100">
                {{ $blog->title }}
            </h1>

            <div class="blog-meta" data-aos="fade-up" data-aos-delay="200">
                <div class="meta-item">
                    <div class="author-avatar">
                        {{ strtoupper(substr($blog->user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <div>{{ $blog->user->name ?? 'Anonymous' }}</div>
                        <small>Author</small>
                    </div>
                </div>

                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $blog->created_at->format('M d, Y') }}</span>
                </div>

                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                </div>

                @if($blog->views_count > 0)
                <div class="meta-item">
                    <i class="fas fa-eye"></i>
                    <span>{{ number_format($blog->views_count) }} views</span>
                </div>
                @endif
            </div>

            @if($blog->description)
            <p class="blog-description" data-aos="fade-up" data-aos-delay="300">
                {{ $blog->description }}
            </p>
            @endif
        </div>
    </header>

    <!-- Content Area -->
    <main class="content-area">
        <div class="container">
            <div class="content-wrapper" data-aos="fade-up">
                <article class="blog-content glass-card">
                    {!! $blog->content !!}
                </article>

                @if($blog->tags && count($blog->tags) > 0)
                <div class="blog-tags" data-aos="fade-up">
                    <h6 class="mb-3" style="color: var(--text-secondary);">Tags:</h6>
                    @foreach($blog->tags as $tag)
                        <a href="{{ route('home.all-blogs', ['tag' => $tag]) }}" class="tag">
                            {{ $tag }}
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Author Section -->
    @if($blog->user)
    <section class="author-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="author-card glass-card" data-aos="fade-up">
                        <div class="author-avatar">
                            {{ strtoupper(substr($blog->user->name, 0, 1)) }}
                        </div>
                        <h3 class="author-name">{{ $blog->user->name }}</h3>
                        <p class="author-bio">
                            Tech professional sharing insights and knowledge through MeetMyTech platform.
                        </p>
                        <a href="{{ url('/') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user me-2"></i>View Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Related Blogs -->
    @if($relatedBlogs->count() > 0)
        <section class="py-5 position-relative">
            <div class="glass-overlay"></div>
            <div class="container position-relative">
                <h3 class="h4 font-weight-bold mb-4 text-white">More from {{ $blog->user->name }}</h3>
                <div class="row">
                    @foreach($relatedBlogs as $relatedBlog)
                        <div class="col-md-6 col-lg-{{ $relatedBlogs->count() > 2 ? '4' : '6' }} mb-4">
                            <article class="card h-100 glass-card border-0">
                                @if($relatedBlog->featured_image)
                                    <img
                                        src="{{ asset('storage/' . $relatedBlog->featured_image) }}"
                                        alt="{{ $relatedBlog->title }}"
                                        class="card-img-top"
                                        style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;"
                                    >
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center"
                                         style="height: 200px; background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%); border-radius: 15px 15px 0 0;">
                                        <span class="text-white h3 font-weight-bold">{{ substr($relatedBlog->title, 0, 1) }}</span>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <div class="text-muted small mb-2">
                                        {{ $relatedBlog->published_at->format('M j, Y') }}
                                    </div>

                                    <h5 class="card-title mb-2">
                                        <a href="{{ url('blogs/' . $relatedBlog->slug) }}" class="text-decoration-none text-white">
                                            {{ $relatedBlog->title }}
                                        </a>
                                    </h5>

                                    @if($relatedBlog->excerpt)
                                        <p class="card-text text-muted small mb-0">
                                            {{ Str::limit($relatedBlog->excerpt, 100) }}
                                        </p>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Comments Section -->
    <section class="py-5 position-relative">
        <div class="glass-overlay"></div>
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Comments Header -->
                    <div class="d-flex align-items-center mb-4">
                        <h3 class="mb-0 me-3 text-white">
                            <i class="fas fa-comments me-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            Discussion & Comments
                        </h3>
                        <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">{{ count($comments) }}</span>
                    </div>

                    <!-- Comment Form -->
                    <div class="card glass-card shadow-lg mb-4 border-0">
                        <div class="card-header text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0;">
                            <h5 class="mb-0">
                                <i class="fas fa-pen me-2"></i>
                                Join the Discussion
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('blogs.comments.store', $blog->slug) }}" method="POST" class="comment-form" id="commentForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="user_name" class="form-label fw-bold text-white">
                                            <i class="fas fa-user me-1" style="color: #667eea;"></i>
                                            Your Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control glass-input @error('user_name') is-invalid @enderror"
                                               id="user_name" name="user_name" value="{{ old('user_name') }}"
                                               placeholder="Enter your name" required maxlength="255"
                                               style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white;">
                                        @error('user_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label fw-bold text-white">
                                        <i class="fas fa-comment-dots me-1" style="color: #667eea;"></i>
                                        Your Comment <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control glass-input @error('message') is-invalid @enderror"
                                              id="message" name="message" rows="4"
                                              placeholder="Share your thoughts about this blog post..."
                                              required maxlength="1000"
                                              style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white;">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="d-flex justify-content-between mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Be respectful and constructive in your comments
                                        </small>
                                        <small class="fw-bold" id="charCount" style="color: #667eea;">0/1000</small>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn text-white fw-bold" id="submitBtn"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                        <i class="fas fa-paper-plane me-2"></i>Post Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Comments Display -->
                    <div class="comments-list">
                        @forelse($comments as $comment)
                            <div class="comment-item mb-4">
                                <div class="card glass-card border-0 shadow-lg">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <!-- Avatar -->
                                            <div class="comment-avatar me-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                                     style="width: 48px; height: 48px; font-size: 18px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    {{ strtoupper(substr($comment->user_name, 0, 1)) }}
                                                </div>
                                            </div>

                                            <!-- Comment Content -->
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="comment-author mb-0 fw-bold" style="color: #667eea;">
                                                        {{ $comment->user_name }}
                                                    </h6>
                                                    <small class="comment-date text-muted">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ $comment->created_at->format('M d, Y \a\t g:i A') }}
                                                    </small>
                                                </div>
                                                <div class="comment-message">
                                                    <p class="mb-0 text-white">{{ $comment->message }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <div class="empty-comments">
                                    <i class="fas fa-comments text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                                    <h5 class="text-muted mb-2">No comments yet</h5>
                                    <p class="text-muted">Be the first to start the discussion!</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <!-- Prism.js for Code Highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-css.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Reading Progress Bar
        function updateReadingProgress() {
            const article = document.querySelector('.blog-content');
            const progressBar = document.getElementById('reading-progress');

            if (article && progressBar) {
                const articleRect = article.getBoundingClientRect();
                const articleHeight = article.offsetHeight;
                const viewportHeight = window.innerHeight;
                const scrolled = window.pageYOffset;
                const articleTop = article.offsetTop;

                // Calculate progress
                const totalReadable = articleHeight - viewportHeight + articleTop;
                const progress = Math.min(Math.max((scrolled - articleTop + viewportHeight) / articleHeight, 0), 1);

                progressBar.style.width = (progress * 100) + '%';
            }
        }

        // Update reading progress on scroll
        window.addEventListener('scroll', updateReadingProgress);
        window.addEventListener('resize', updateReadingProgress);

        // Initialize reading progress
        updateReadingProgress();

        // Enhanced code block styling
        document.addEventListener('DOMContentLoaded', function() {
            // Character count for comment textarea
            const messageTextarea = document.getElementById('message');
            const charCount = document.getElementById('charCount');
            const submitBtn = document.getElementById('submitBtn');
            const commentForm = document.getElementById('commentForm');

            if (messageTextarea && charCount) {
                function updateCharCount() {
                    const currentLength = messageTextarea.value.length;
                    charCount.textContent = currentLength + '/1000';

                    // Change color when approaching limit
                    if (currentLength > 900) {
                        charCount.style.color = '#ff6b6b';
                    } else if (currentLength > 800) {
                        charCount.style.color = '#ffd93d';
                    } else {
                        charCount.style.color = '#667eea';
                    }
                }

                // Update on input
                messageTextarea.addEventListener('input', updateCharCount);
                messageTextarea.addEventListener('keyup', updateCharCount);
                messageTextarea.addEventListener('paste', function() {
                    setTimeout(updateCharCount, 10);
                });

                // Initial count (for old values)
                updateCharCount();
            }

            // Form submission handling
            if (commentForm && submitBtn) {
                commentForm.addEventListener('submit', function(e) {
                    const userName = document.getElementById('user_name').value.trim();
                    const message = messageTextarea.value.trim();

                    if (!userName || !message) {
                        e.preventDefault();
                        alert('Please fill in both name and comment fields.');
                        return false;
                    }

                    if (message.length > 1000) {
                        e.preventDefault();
                        alert('Comment is too long. Please keep it under 1000 characters.');
                        return false;
                    }

                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Posting...';
                });
            }

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    if (bootstrap && bootstrap.Alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    } else {
                        alert.style.display = 'none';
                    }
                }, 5000);
            });

            // Add copy buttons to code blocks
            document.querySelectorAll('pre').forEach(function(pre) {
                const copyButton = document.createElement('button');
                copyButton.textContent = 'Copy';
                copyButton.className = 'btn btn-sm position-absolute top-0 end-0 m-2';
                copyButton.style.fontSize = '0.75rem';
                copyButton.style.background = 'var(--glass-bg)';
                copyButton.style.borderColor = 'var(--glass-border)';
                copyButton.style.color = 'var(--text-primary)';
                copyButton.style.backdropFilter = 'blur(10px)';

                pre.style.position = 'relative';
                pre.appendChild(copyButton);

                copyButton.addEventListener('click', function() {
                    const code = pre.querySelector('code');
                    navigator.clipboard.writeText(code.textContent).then(function() {
                        copyButton.textContent = 'Copied!';
                        copyButton.style.background = 'var(--holo-quaternary)';
                        copyButton.style.color = 'white';
                        setTimeout(function() {
                            copyButton.textContent = 'Copy';
                            copyButton.style.background = 'var(--glass-bg)';
                            copyButton.style.color = 'var(--text-primary)';
                        }, 2000);
                    });
                });
            });

            // Enhanced glassmorphism hover effects
            document.querySelectorAll('.tag').forEach(tag => {
                tag.addEventListener('mouseenter', function() {
                    this.style.background = 'rgba(255, 255, 255, 0.12)';
                    this.style.transform = 'translateY(-2px) scale(1.05)';
                });

                tag.addEventListener('mouseleave', function() {
                    this.style.background = 'var(--glass-bg)';
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add subtle parallax effect to content
            window.addEventListener('scroll', function() {
                const contentCard = document.querySelector('.blog-content');
                const scrolled = window.pageYOffset;

                if (contentCard) {
                    const rate = scrolled * -0.2;
                    contentCard.style.transform = `translateY(${rate}px)`;
                }
            });
        });
    </script>
</body>
</html>
