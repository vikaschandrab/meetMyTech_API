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
            --bg-primary: #0a0a0a;
            --bg-secondary: #1a1a1a;
            --bg-tertiary: #2a2a2a;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --text-muted: #666666;
            --accent-primary: #00d4ff;
            --accent-secondary: #7c3aed;
            --accent-tertiary: #f59e0b;
            --border-color: #333333;
            --gradient-primary: linear-gradient(135deg, #00d4ff 0%, #7c3aed 100%);
            --gradient-secondary: linear-gradient(135deg, #7c3aed 0%, #f59e0b 100%);
            --shadow-glow: 0 0 30px rgba(0, 212, 255, 0.3);
            --shadow-purple: 0 0 30px rgba(124, 58, 237, 0.3);
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
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(0, 212, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(124, 58, 237, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(245, 158, 11, 0.05) 0%, transparent 50%);
            z-index: -1;
            animation: backgroundShift 20s ease-in-out infinite;
        }

        @keyframes backgroundShift {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        /* Header Styles */
        .blog-header {
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-tertiary) 100%);
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid var(--border-color);
        }

        .blog-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            opacity: 0.1;
            z-index: 1;
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
            background: var(--gradient-primary);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
        }

        .blog-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            color: var(--text-secondary);
            max-width: 600px;
        }

        /* Navigation Back Button */
        .back-nav {
            background: rgba(0, 212, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 212, 255, 0.3);
            border-radius: 50px;
            padding: 12px 24px;
            color: var(--accent-primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-nav:hover {
            background: rgba(0, 212, 255, 0.2);
            color: var(--accent-primary);
            transform: translateX(-5px);
            box-shadow: var(--shadow-glow);
        }

        /* Search and Filter Section */
        .search-section {
            background: var(--bg-secondary);
            padding: 60px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .search-card {
            background: var(--bg-tertiary);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .search-form .form-control {
            background: var(--bg-primary);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            color: var(--text-primary);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .search-form .form-control:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2);
            background: var(--bg-primary);
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
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
            color: white;
        }

        /* Tags */
        .tag {
            background: rgba(0, 212, 255, 0.1);
            color: var(--accent-primary);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            margin: 4px;
            border: 1px solid rgba(0, 212, 255, 0.3);
            transition: all 0.3s ease;
        }

        .tag:hover {
            background: var(--accent-primary);
            color: var(--bg-primary);
            transform: translateY(-1px);
            box-shadow: var(--shadow-glow);
        }

        /* Blog Grid */
        .blogs-section {
            padding: 80px 0;
            background: var(--bg-primary);
        }

        .blog-card {
            background: var(--bg-secondary);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border-color);
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
            background: var(--gradient-primary);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 20px;
            z-index: 1;
        }

        .blog-card:hover::before {
            opacity: 0.05;
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-glow);
            border-color: rgba(0, 212, 255, 0.5);
        }

        .blog-card > * {
            position: relative;
            z-index: 2;
        }

        .blog-image {
            height: 220px;
            background: var(--gradient-primary);
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
                radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .blog-image i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.9);
            z-index: 2;
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
            color: var(--accent-primary);
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
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
            border-top: 1px solid var(--border-color);
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
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
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
            color: var(--text-muted);
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
            padding: 12px 16px;
            margin: 0 4px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: var(--accent-primary);
            border-color: var(--accent-primary);
            color: var(--bg-primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .pagination .page-item.active .page-link {
            background: var(--gradient-primary);
            border-color: var(--accent-primary);
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

        /* Glow animations */
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(0, 212, 255, 0.3); }
            50% { box-shadow: 0 0 30px rgba(0, 212, 255, 0.5); }
        }

        .blog-card:hover {
            animation: glow 2s ease-in-out infinite;
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
            <div class="search-card" data-aos="fade-up">
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
                            <article class="blog-card">
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
            duration: 800,
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

            // Enhanced hover effects
            document.querySelectorAll('.blog-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
</body>
</html>
