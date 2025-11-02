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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
            --light-gray: #f8fafc;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 120px 0 100px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .stats-section {
            background: var(--light-gray);
            padding: 80px 0;
        }

        .stat-card {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .blog-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .blog-image {
            height: 200px;
            object-fit: cover;
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 20px;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--dark-color) 0%, #374151 100%);
            color: white;
            padding: 100px 0;
        }

        .tag-cloud .badge {
            margin: 3px;
            padding: 8px 15px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 20px;
        }

        .contributor-card {
            text-align: center;
            padding: 25px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .contributor-card:hover {
            transform: translateY(-5px);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 60px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
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
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#community">Community</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.all-blogs') }}">All Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.mock-interview') }}">Mock Interview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary px-3 ms-2" href="{{ route('contact') }}">Get Started</a>
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
                    <h1 class="display-4 fw-bold mb-4">
                        Showcase Your <span class="text-warning">Tech Journey</span> & Share Knowledge
                    </h1>
                    <p class="lead mb-5">
                        MeetMyTech is the perfect platform for tech professionals to create stunning portfolios,
                        share insights through blogs, and connect with like-minded developers worldwide.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('contact') }}" class="btn btn-warning btn-lg px-4 py-3">
                            <i class="fas fa-rocket me-2"></i>Start Your Journey
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-user-plus me-2"></i>Get Started
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="text-center">
                        <i class="fas fa-laptop-code" style="font-size: 15rem; opacity: 0.3;"></i>
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
                        <h5 class="text-muted">Tech Professionals</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format($stats['total_blogs']) }}</div>
                        <h5 class="text-muted">Published Blogs</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format($stats['total_views']) }}</div>
                        <h5 class="text-muted">Total Views</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format($stats['active_writers']) }}</div>
                        <h5 class="text-muted">Active Writers</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
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
                        <h4>Professional Portfolios</h4>
                        <p class="text-muted">Create stunning portfolios that showcase your skills, experience, and projects to potential employers and clients.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-blog"></i>
                        </div>
                        <h4>Rich Blog Platform</h4>
                        <p class="text-muted">Share your knowledge and insights with our advanced blog editor featuring rich text formatting and media support.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Community Network</h4>
                        <p class="text-muted">Connect with fellow developers, learn from experts, and grow your professional network in the tech industry.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Analytics & Insights</h4>
                        <p class="text-muted">Track your blog performance, view statistics, and understand your audience engagement with detailed analytics.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Mobile Responsive</h4>
                        <p class="text-muted">Your portfolio and blogs look perfect on all devices, ensuring a great experience for every visitor.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4>SEO Optimized</h4>
                        <p class="text-muted">Built-in SEO optimization helps your content rank better in search engines and reach a wider audience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Blogs Section -->
    @if($featuredBlogs->count() > 0)
    <section id="blogs" class="py-5 bg-light">
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
                            <h5 class="card-title">{{ Str::limit($blog->title, 50) }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($blog->description, 100) }}</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    by {{ $blog->user->name }}
                                </small>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-outline-primary btn-sm">Read More</a>
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
    <section class="py-5">
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
                            <h6 class="card-title">{{ Str::limit($blog->title, 40) }}</h6>
                            <p class="card-text text-muted small flex-grow-1">{{ Str::limit($blog->description, 80) }}</p>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <small class="text-muted">by {{ $blog->user->name }}</small>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-outline-primary btn-sm">Read</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('home.all-blogs') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-right me-2"></i>View All Blogs
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Popular Tags -->
    @if(count($popularTags) > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h3 data-aos="fade-up">Popular Topics</h3>
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
    <section id="community" class="py-5">
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
                        <h6 class="mb-2">{{ $contributor->name }}</h6>
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
                    <a href="{{ route('contact') }}" class="btn btn-warning btn-lg px-5 py-3">
                        <i class="fas fa-rocket me-2"></i>Get Started Today
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

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
    </script>
</body>
</html>
