<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs - MeetMyTech</title>
    <meta name="description" content="Explore all blogs from tech professionals on MeetMyTech. Discover insights, tutorials, and knowledge from our community of developers and tech experts.">

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
            line-height: 1.6;
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
            padding: 120px 0 80px;
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

        .blog-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
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

        .blog-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            color: var(--text-secondary);
            max-width: 600px;
        }

        /* Navigation Back Button */
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

        /* Search and Filter Section */
        .search-section {
            background: var(--bg-secondary);
            padding: 60px 0;
            position: relative;
        }

        .search-card {
            border-radius: 24px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .search-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--holo-primary);
            opacity: 0.05;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }

        .search-form .form-control {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 2px solid var(--glass-border);
            border-radius: 16px;
            padding: 12px 16px;
            color: var(--text-primary);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .search-form .form-control:focus {
            border-color: var(--neon-blue);
            box-shadow: var(--soft-glow) var(--neon-blue);
            background: var(--glass-bg);
            color: var(--text-primary);
        }

        .search-form .form-control::placeholder {
            color: var(--text-muted);
        }

        .search-form .form-label {
            color: var(--text-secondary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .btn-search {
            background: var(--holo-tertiary);
            border: none;
            color: white;
            padding: 12px 32px;
            border-radius: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-search::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.3s ease;
            transform: translate(-50%, -50%);
        }

        .btn-search:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: var(--neon-glow) var(--neon-blue);
            color: white;
        }

        /* Tags */
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
            margin: 4px;
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

        /* Blog Grid */
        .blogs-section {
            padding: 80px 0;
            background: var(--bg-primary);
        }

        .blog-card {
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .blog-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--holo-primary);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 24px;
            z-index: 1;
        }

        .blog-card:hover::before {
            opacity: 0.1;
        }

        .blog-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: var(--neon-glow) var(--neon-purple);
        }

        .blog-card > * {
            position: relative;
            z-index: 2;
        }

        .blog-image {
            height: 220px;
            background: var(--holo-secondary);
            position: relative;
            overflow: hidden;
        }

        .blog-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.2) 0%, transparent 50%);
            animation: imageShimmer 4s ease-in-out infinite;
        }

        @keyframes imageShimmer {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .blog-image i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3.5rem;
            color: rgba(255, 255, 255, 0.9);
            z-index: 2;
            animation: iconFloat 3s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translate(-50%, -50%) translateY(0px); }
            50% { transform: translate(-50%, -50%) translateY(-5px); }
        }

        .blog-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-title-card {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--text-primary);
            text-decoration: none;
            line-height: 1.4;
            transition: all 0.3s ease;
        }

        .blog-title-card:hover {
            background: var(--holo-tertiary);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: var(--soft-glow) var(--neon-blue);
        }

        .blog-excerpt {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--glass-border);
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .author-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--holo-quaternary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: var(--soft-glow) var(--neon-green);
            animation: avatarPulse 2s ease-in-out infinite;
        }

        @keyframes avatarPulse {
            0%, 100% { box-shadow: var(--soft-glow) var(--neon-green); }
            50% { box-shadow: 0 0 25px var(--neon-green); }
        }

        .blog-date {
            display: flex;
            align-items: center;
            gap: 4px;
            color: var(--text-secondary);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            background: var(--holo-rainbow);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textGlow 3s ease-in-out infinite alternate;
        }

        .empty-state h3 {
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Pagination */
        .pagination {
            margin-top: 3rem;
            justify-content: center;
        }

        .pagination .page-link {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 2px solid var(--glass-border);
            color: var(--text-primary);
            padding: 12px 16px;
            margin: 0 4px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: var(--holo-tertiary);
            border-color: var(--neon-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--soft-glow) var(--neon-blue);
        }

        .pagination .page-item.active .page-link {
            background: var(--holo-primary);
            border-color: var(--neon-purple);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .blog-title {
                font-size: 2.5rem;
            }

            .blog-header {
                padding: 80px 0 60px;
            }

            .search-section {
                padding: 40px 0;
            }

            .blogs-section {
                padding: 60px 0;
            }

            .search-card {
                padding: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .blog-title {
                font-size: 2rem;
            }

            .blog-subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Blog Header -->
    <header class="blog-header">
        <div class="container">
            <a href="{{ url('/') }}" class="back-nav" data-aos="fade-right">
                <i class="fas fa-arrow-left"></i>
                Back to Portfolio
            </a>

            <h1 class="blog-title" data-aos="fade-up" data-aos-delay="100">
                Tech Insights & Tutorials
            </h1>
            <p class="blog-subtitle" data-aos="fade-up" data-aos-delay="200">
                Discover the latest in technology, programming, and innovation from our community of experts
            </p>
        </div>
    </header>

    <!-- Search and Filter Section -->
    <section class="search-section">
        <div class="container">
            <div class="search-card glass-card" data-aos="fade-up">
                <form method="GET" action="{{ route('home.all-blogs') }}" class="search-form">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="search" class="form-label">
                                <i class="fas fa-search me-2"></i>Search Articles
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="search"
                                   name="search"
                                   placeholder="Search by title, content, or tags..."
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-search w-100">
                                <i class="fas fa-search me-2"></i>Search
                            </button>
                        </div>
                    </div>
                </form>

                @if(count($popularTags) > 0)
                    <div class="mt-4">
                        <h6 class="mb-3" style="color: var(--text-secondary);">Popular Tags:</h6>
                        @foreach($popularTags as $tagName => $count)
                            <a href="{{ route('home.all-blogs', ['tag' => $tagName]) }}" class="tag">
                                {{ $tagName }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Blogs Section -->
    <section class="blogs-section">
        <div class="container">
            @if($blogs->count() > 0)
                <div class="row g-4">
                    @foreach($blogs as $index => $blog)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <article class="blog-card glass-card">
                                <div class="blog-image">
                                    <i class="fas fa-code"></i>
                                </div>

                                <div class="blog-content">
                                    <h3>
                                        <a href="{{ route('blogs.show', $blog->slug) }}" class="blog-title-card">
                                            {{ $blog->title }}
                                        </a>
                                    </h3>

                                    <p class="blog-excerpt">
                                        {!! Str::limit(strip_tags($blog->content), 120) !!}
                                    </p>

                                    <div class="blog-meta">
                                        <div class="blog-author">
                                            <div class="author-avatar">
                                                {{ strtoupper(substr($blog->user->name ?? 'A', 0, 1)) }}
                                            </div>
                                            <span>{{ $blog->user->name ?? 'Anonymous' }}</span>
                                        </div>

                                        <div class="blog-date">
                                            <i class="fas fa-calendar"></i>
                                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($blogs->hasPages())
                    <div class="d-flex justify-content-center">
                        {{ $blogs->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state" data-aos="fade-up">
                    <div class="empty-state-icon">
                        <i class="fas fa-blog"></i>
                    </div>
                    <h3>No Articles Found</h3>
                    <p>We couldn't find any articles matching your search criteria. Try adjusting your filters or search terms.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Enhanced search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const searchForm = document.querySelector('.search-form');

            // Auto-submit on tag click
            document.querySelectorAll('.tag').forEach(tag => {
                tag.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tagName = this.textContent.trim();
                    searchInput.value = tagName;
                    searchForm.submit();
                });
            });

            // Enhanced hover effects with glassmorphism
            document.querySelectorAll('.blog-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.background = 'rgba(255, 255, 255, 0.12)';
                    this.style.transform = 'translateY(-12px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.background = 'rgba(255, 255, 255, 0.08)';
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add subtle parallax effect to cards
            window.addEventListener('scroll', function() {
                const cards = document.querySelectorAll('.blog-card');
                const scrolled = window.pageYOffset;

                cards.forEach((card, index) => {
                    const rate = scrolled * -0.5;
                    card.style.transform = `translateY(${rate}px)`;
                });
            });
        });
    </script>
</body>
</html>
