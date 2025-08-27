<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetMyTech - Showcase Your Tech Journey & Share Knowledge</title>
    <meta name="description" content="MeetMyTech is a platform for tech professionals to showcase their portfolios and share knowledge through blogs. Connect, learn, and grow with the tech community.">
    <meta name="keywords" content="tech portfolio, programming blogs, developer showcase, technology, coding, web development">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('meetmytech_favicon.jpg') }}" type="image/jpeg">
    <link rel="shortcut icon" href="{{ asset('meetmytech_favicon.jpg') }}" />

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/68ac1b458a4c631923aa5b33/1j3g4l2jb';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --dark-color: #1f2937;
            --light-gray: #f8fafc;
            --border-color: #e5e7eb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --shadow-light: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-large: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.7;
            color: var(--text-primary);
            background-color: #ffffff;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 140px 0 120px;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.05"><polygon points="1000,100 1000,0 0,100"/></svg>');
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            line-height: 1.6;
        }

        .stats-section {
            background: var(--light-gray);
            padding: 100px 0;
            position: relative;
        }

        .stat-card {
            text-align: center;
            padding: 40px 30px;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-medium);
            transition: all 0.4s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-large);
        }

        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 15px;
            line-height: 1;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin: 0;
        }

        .blog-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-medium);
            transition: all 0.4s ease;
            height: 100%;
            background: white;
            border: 1px solid var(--border-color);
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-large);
        }

        .blog-image {
            height: 220px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        }

        .feature-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            margin: 0 auto 25px;
            box-shadow: var(--shadow-medium);
            transition: all 0.3s ease;
        }

        .feature-icon:hover {
            transform: scale(1.05);
        }

        .cta-section {
            background: linear-gradient(135deg, var(--dark-color) 0%, #374151 100%);
            color: white;
            padding: 120px 0;
            position: relative;
        }

        .tag-cloud .badge {
            margin: 5px;
            padding: 10px 18px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tag-cloud .badge:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .contributor-card {
            text-align: center;
            padding: 30px 25px;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-medium);
            transition: all 0.4s ease;
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .contributor-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-large);
        }

        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 60px;
            position: relative;
            color: var(--text-primary);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }

        .btn-custom {
            padding: 14px 32px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            box-shadow: var(--shadow-medium);
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-large);
        }

        .btn-outline-custom {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .btn-outline-custom:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
            border-bottom: 1px solid var(--border-color);
        }

        .card-body {
            padding: 25px;
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand text-primary" href="{{ route('home') }}">
                <img src="{{ asset('meetmytech_logo.jpg') }}" alt="MeetMyTech" style="height: 32px; width: auto; margin-right: 8px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#community">Community</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('home.all-blogs') }}">All Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white px-4 ms-2" href="{{ route('contact') }}">Get Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1 class="hero-title">
                        Showcase Your <span class="text-warning">Tech Journey</span> & Share Knowledge
                    </h1>
                    <p class="hero-subtitle">
                        MeetMyTech is the perfect platform for tech professionals to create stunning portfolios,
                        share insights through blogs, and connect with like-minded developers worldwide.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('contact') }}" class="btn-custom btn-primary-custom">
                            <i class="fas fa-rocket"></i>Start Your Journey
                        </a>
                        <a href="{{ route('contact') }}" class="btn-custom btn-outline-custom">
                            <i class="fas fa-user-plus"></i>Get Started
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="text-center">
                        <i class="fas fa-laptop-code" style="font-size: 18rem; opacity: 0.15;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format($stats['total_users']) }}</div>
                        <h5 class="stat-label">Tech Professionals</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format($stats['total_blogs']) }}</div>
                        <h5 class="stat-label">Published Blogs</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format($stats['total_views']) }}</div>
                        <h5 class="stat-label">Total Views</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format($stats['active_writers']) }}</div>
                        <h5 class="stat-label">Active Writers</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5" style="padding: 120px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Why Choose MeetMyTech?</h2>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Professional Portfolios</h4>
                        <p class="text-muted">Create stunning portfolios that showcase your skills, experience, and projects to potential employers and clients.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-blog"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Rich Blog Platform</h4>
                        <p class="text-muted">Share your knowledge and insights with our advanced blog editor featuring rich text formatting and media support.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Community Network</h4>
                        <p class="text-muted">Connect with fellow developers, learn from experts, and grow your professional network in the tech industry.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Analytics & Insights</h4>
                        <p class="text-muted">Track your blog performance, view statistics, and understand your audience engagement with detailed analytics.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Mobile Responsive</h4>
                        <p class="text-muted">Your portfolio and blogs look perfect on all devices, ensuring a great experience for every visitor.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4 class="fw-bold mb-3">SEO Optimized</h4>
                        <p class="text-muted">Built-in SEO optimization helps your content rank better in search engines and reach a wider audience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Blogs Section -->
    @if($featuredBlogs->count() > 0)
    <section id="blogs" class="py-5 bg-light" style="padding: 120px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Featured Blogs</h2>
                    <p class="lead text-muted">Discover the best content from our community</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach($featuredBlogs as $blog)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="card blog-card">
                        @if($blog->featured_image)
                            <img src="{{ asset('storage/'.$blog->featured_image) }}" class="card-img-top blog-image" alt="{{ $blog->title }}">
                        @else
                            <div class="blog-image d-flex align-items-center justify-content-center">
                                <i class="fas fa-code text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $blog->published_at->format('M d, Y') }}
                                </small>
                                <span class="badge bg-primary ms-auto">Featured</span>
                            </div>
                            <h5 class="card-title fw-bold">{{ Str::limit($blog->title, 50) }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($blog->description, 100) }}</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    by {{ $blog->user->name }}
                                </small>
                                <a href="{{ url('blogs/' . $blog->slug) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Latest Blogs Section -->
    @if($latestBlogs->count() > 0)
    <section class="py-5" style="padding: 120px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Latest from Our Community</h2>
                </div>
            </div>
            <div class="row g-4">
                @foreach($latestBlogs->take(4) as $blog)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="card blog-card h-100">
                        @if($blog->featured_image)
                            <img src="{{ asset('storage/'.$blog->featured_image) }}" class="card-img-top blog-image" alt="{{ $blog->title }}">
                        @else
                            <div class="blog-image d-flex align-items-center justify-content-center">
                                <i class="fas fa-laptop-code text-white" style="font-size: 2rem;"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted mb-2">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $blog->published_at->format('M d, Y') }}
                            </small>
                            <h6 class="card-title fw-bold">{{ Str::limit($blog->title, 40) }}</h6>
                            <p class="card-text text-muted small flex-grow-1">{{ Str::limit($blog->description, 80) }}</p>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <small class="text-muted">by {{ $blog->user->name }}</small>
                                <a href="{{ url('blogs/' . $blog->slug) }}" class="btn btn-outline-primary btn-sm">Read</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('home.all-blogs') }}" class="btn-custom btn-primary-custom">
                    <i class="fas fa-arrow-right"></i>View All Blogs
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Popular Tags -->
    @if(count($popularTags) > 0)
    <section class="py-5 bg-light" style="padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h3 class="fw-bold" data-aos="fade-up">Popular Topics</h3>
                </div>
                <div class="col-12 text-center">
                    <div class="tag-cloud" data-aos="fade-up">
                        @foreach($popularTags as $tag => $count)
                            <a href="{{ route('home.all-blogs', ['tag' => $tag]) }}" class="badge bg-primary text-decoration-none">
                                {{ $tag }} ({{ $count }})
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Top Contributors -->
    @if($topContributors->count() > 0)
    <section id="community" class="py-5" style="padding: 120px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Top Contributors</h2>
                    <p class="lead text-muted">Meet the amazing minds sharing knowledge with our community</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach($topContributors as $contributor)
                <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="contributor-card">
                        <div class="mb-3">
                            @if($contributor->profilePic)
                                <img src="{{ asset('storage/'.$contributor->profilePic) }}"
                                     alt="{{ $contributor->name }}"
                                     class="rounded-circle"
                                     style="width: 80px; height: 80px; object-fit: cover; border: 3px solid var(--primary-color);">
                            @else
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white"
                                     style="width: 80px; height: 80px; margin: 0 auto; font-size: 2rem; font-weight: bold;">
                                    {{ strtoupper(substr($contributor->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <h6 class="mb-2 fw-bold">{{ $contributor->name }}</h6>
                        <small class="text-muted">{{ $contributor->blogs_count }} {{ Str::plural('blog', $contributor->blogs_count) }}</small>
                        <div class="mt-2">
                            @if($contributor->slug)
                                <a href="{{ \App\Helpers\UrlHelper::profileSubdomain($contributor->slug) }}" class="btn btn-outline-primary btn-sm" target="_blank">View Profile</a>
                            @else
                                <span class="btn btn-outline-secondary btn-sm disabled">No Profile</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto" data-aos="fade-up">
                    <h2 class="display-5 fw-bold mb-4">Ready to Start Your Tech Journey?</h2>
                    <p class="lead mb-5">
                        Join thousands of tech professionals who are already showcasing their skills and sharing knowledge on MeetMyTech.
                    </p>
                    <a href="{{ route('contact') }}" class="btn-custom btn-primary-custom" style="background: linear-gradient(135deg, var(--accent-color), #f97316); font-size: 1.1rem; padding: 16px 40px;">
                        <i class="fas fa-rocket"></i>Get Started Today
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5" style="padding: 80px 0 40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="text-gradient fw-bold">
                        <i class="fas fa-code me-2"></i>MeetMyTech
                    </h5>
                    <p class="text-muted">
                        Empowering tech professionals to showcase their journey and share knowledge with the world.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold">Platform</h6>
                    <ul class="list-unstyled">
                        <li><a href="#features" class="text-muted text-decoration-none">Features</a></li>
                        <li><a href="{{ route('home.all-blogs') }}" class="text-muted text-decoration-none">All Blogs</a></li>
                        <li><a href="{{ route('login') }}" class="text-muted text-decoration-none">Sign Up</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold">Community</h6>
                    <ul class="list-unstyled">
                        <li><a href="#community" class="text-muted text-decoration-none">Contributors</a></li>
                        <li><a href="#blogs" class="text-muted text-decoration-none">Featured Blogs</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="fw-bold">Stay Updated</h6>
                    <p class="text-muted small">Follow the latest trends and insights from our tech community.</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted small mb-0">
                        © {{ date('Y') }} MeetMyTech. Built with ❤️ for the tech community.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-muted">
                        Developed and maintained by <a href="https://meetmytech.com" class="text-warning text-decoration-none">meetmytech.com</a>
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = target.offsetTop - navHeight;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow');
            } else {
                navbar.classList.remove('shadow');
            }
        });

        // Add floating animation to hero icon
        const heroIcon = document.querySelector('.hero-section i');
        if (heroIcon) {
            setInterval(() => {
                heroIcon.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    heroIcon.style.transform = 'translateY(0)';
                }, 1000);
            }, 2000);
        }
    </script>
</body>
</html>
