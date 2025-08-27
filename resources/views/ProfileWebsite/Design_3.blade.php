<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    use Illuminate\Support\Str;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>{{ $UserDetails->name }} - Personal CV/Resume</title>
    @if($UserDetails->seo_description)
    <meta name="description" content="{{ $UserDetails->seo_description }}">
    @endif
    @if($UserDetails->seo_keywords)
    <meta name="keywords" content="{{ $UserDetails->seo_keywords }}">
    @endif
    <meta name="author" content="{{ $UserDetails->name }}">
    <meta name="robots" content="index, follow">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="{{ $UserDetails->name }} - Personal CV/Resume">
    @if ($UserDetails->seo_description)
    <meta property="og:description" content="{{ $UserDetails->seo_description }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($UserDetails->profilePic)
    <meta property="og:image" content="{{ asset('storage/'.$UserDetails->profilePic) }}">
    @endif

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $UserDetails->name }} - Personal CV/Resume">
    <meta name="twitter:description" content="Skilled developer with expertise in modern web technologies">
    @if($UserDetails->profilePic)
    <meta name="twitter:image" content="{{ asset('storage/'.$UserDetails->profilePic) }}">
    @endif

    {{-- Favicons --}}
    @if($UserDetails->logo_16_14_ico && $UserDetails->logo_16_14_png && $UserDetails->logo_72_72_png && $UserDetails->logo_114_114_png)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/'.$UserDetails->logo_16_14_ico) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/'.$UserDetails->logo_16_14_png) }}">
    <link rel="icon" type="image/png" sizes="72x72" href="{{ asset('storage/'.$UserDetails->logo_72_72_png) }}">
    <link rel="icon" type="image/png" sizes="114x114" href="{{ asset('storage/'.$UserDetails->logo_114_114_png) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/'.$UserDetails->logo_114_114_png) }}">
    @endif

    {{-- Modern Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Modern CSS Framework --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Ultra Modern Design System --}}
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #ffffff;
            --text-secondary: #b8b8b8;
            --card-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            --glow-shadow: 0 0 20px rgba(102, 126, 234, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-gradient);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Ultra Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gradient);
            border-radius: 10px;
        }

        /* Floating Navigation */
        .modern-nav {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 15px 30px;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modern-nav:hover {
            transform: translateX(-50%) translateY(-2px);
            box-shadow: var(--glow-shadow);
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            margin: 0;
        }

        .nav-links a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: var(--primary-gradient);
            transform: translateY(-1px);
        }

        /* Hero Section - Futuristic */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: radial-gradient(ellipse at top, #667eea 0%, transparent 50%),
                        radial-gradient(ellipse at bottom, #764ba2 0%, transparent 50%),
                        var(--dark-gradient);
            overflow: hidden;
        }

        .hero-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(102, 126, 234, 0.3) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(118, 75, 162, 0.3) 2px, transparent 2px);
            background-size: 50px 50px;
            animation: particles 20s linear infinite;
        }

        @keyframes particles {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-50px) translateY(-50px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ffffff 0%, #667eea 50%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-secondary);
            margin-bottom: 30px;
            font-weight: 300;
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin-bottom: 40px;
            line-height: 1.8;
        }

        .modern-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: var(--primary-gradient);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .modern-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .modern-btn:hover::before {
            left: 100%;
        }

        .modern-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--glow-shadow);
        }

        .modern-btn-outline {
            background: transparent;
            border: 2px solid var(--glass-border);
            backdrop-filter: blur(10px);
        }

        .modern-btn-outline:hover {
            background: var(--glass-bg);
            border-color: var(--text-primary);
        }

        /* Profile Image - Holographic */
        .profile-container {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .profile-hologram {
            position: relative;
            width: 400px;
            height: 400px;
        }

        .profile-ring {
            position: absolute;
            border: 2px solid transparent;
            border-radius: 50%;
            animation: rotate 10s linear infinite;
        }

        .profile-ring:nth-child(1) {
            width: 100%;
            height: 100%;
            background: conic-gradient(from 0deg, #667eea, #764ba2, #667eea);
            padding: 3px;
        }

        .profile-ring:nth-child(2) {
            width: 110%;
            height: 110%;
            top: -5%;
            left: -5%;
            background: conic-gradient(from 180deg, #f093fb, #f5576c, #f093fb);
            padding: 2px;
            animation-delay: -2s;
        }

        .profile-ring:nth-child(3) {
            width: 120%;
            height: 120%;
            top: -10%;
            left: -10%;
            background: conic-gradient(from 90deg, #4facfe, #00f2fe, #4facfe);
            padding: 1px;
            animation-delay: -4s;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            position: relative;
            z-index: 1;
        }

        /* Glassmorphism Cards */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--primary-gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .glass-card:hover::before {
            transform: scaleX(1);
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Section Styles */
        .modern-section {
            padding: 120px 0;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-badge {
            display: inline-block;
            background: var(--primary-gradient);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ffffff 0%, #667eea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-description {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Skills - Neon Style */
        .skill-item {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .skill-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: var(--primary-gradient);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .skill-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--glow-shadow);
        }

        .skill-item:hover .skill-icon {
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Timeline - Futuristic */
        .timeline {
            position: relative;
            padding-left: 40px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary-gradient);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 40px;
            padding-left: 40px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -49px;
            top: 0;
            width: 20px;
            height: 20px;
            background: var(--primary-gradient);
            border-radius: 50%;
            border: 4px solid #0c0c0c;
        }

        .timeline-content {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 30px;
        }

        /* Contact Form - Modern */
        .modern-form {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 50px;
        }

        .form-floating {
            margin-bottom: 25px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 16px;
            padding: 20px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #667eea;
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
            color: var(--text-primary);
        }

        .form-label {
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Footer - Minimal */
        .modern-footer {
            background: #0a0a0a;
            padding: 60px 0 30px;
            border-top: 1px solid var(--glass-border);
        }

        .social-links {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
        }

        .social-link {
            width: 50px;
            height: 50px;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary-gradient);
            transform: translateY(-3px);
            box-shadow: var(--glow-shadow);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modern-nav {
                position: fixed;
                bottom: 20px;
                top: auto;
                left: 20px;
                right: 20px;
                transform: none;
                border-radius: 20px;
                padding: 15px 20px;
            }

            .nav-links {
                justify-content: space-around;
                gap: 10px;
            }

            .nav-links a {
                font-size: 12px;
                padding: 6px 12px;
            }

            .hero-title {
                font-size: 3rem;
            }

            .profile-hologram {
                width: 300px;
                height: 300px;
            }

            .modern-form {
                padding: 30px 20px;
            }
        }

        /* Loading Animation */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--dark-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loader-ring {
            width: 100px;
            height: 100px;
            border: 3px solid transparent;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-ring"></div>
    </div>

    <!-- Modern Navigation -->
    <nav class="modern-nav">
        <ul class="nav-links">
            <li><a href="#home" class="nav-link active">Home</a></li>
            <li><a href="#about" class="nav-link">About</a></li>
            <li><a href="#skills" class="nav-link">Skills</a></li>
            <li><a href="#experience" class="nav-link">Experience</a></li>
            <li><a href="#blogs" class="nav-link">Blogs</a></li>
            <li><a href="#contact" class="nav-link">Contact</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-particles"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="hero-content">
                        <h1 class="hero-title">{{ $UserDetails->name }}</h1>
                        <p class="hero-subtitle">
                            @if($WorkExperiences && $WorkExperiences->count() > 0)
                                {{ $WorkExperiences->first()->position }}
                            @else
                                Full Stack Developer
                            @endif
                        </p>
                        <p class="hero-description">
                            I create exceptional digital experiences that combine cutting-edge technology with stunning design.
                            Let's build something amazing together.
                        </p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="#contact" class="modern-btn">
                                <i class="fas fa-envelope"></i>
                                Get In Touch
                            </a>
                            <a href="#about" class="modern-btn modern-btn-outline">
                                <i class="fas fa-user"></i>
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    @if($UserDetails->profilePic)
                    <div class="profile-container">
                        <div class="profile-hologram">
                            <div class="profile-ring"></div>
                            <div class="profile-ring"></div>
                            <div class="profile-ring"></div>
                            <img src="{{ asset('storage/'.$UserDetails->profilePic) }}" alt="{{ $UserDetails->name }}" class="profile-image">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="modern-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">About Me</div>
                <h2 class="section-title">Crafting Digital Excellence</h2>
                <p class="section-description">
                    Passionate developer with a keen eye for detail and a drive for innovation
                </p>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="glass-card" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="mb-4">Hello! I'm {{ $UserDetails->name }}</h3>
                        <p class="mb-4">
                            @if(isset($UserDetails->about) && !empty($UserDetails->about))
                                {{ $UserDetails->about }}
                            @else
                                I'm a passionate developer who loves creating beautiful, functional, and user-friendly applications.
                                With years of experience in modern web technologies, I bring ideas to life through clean code and innovative solutions.
                            @endif
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-envelope text-primary me-2"></i> {{ $UserDetails->email }}</li>
                                    @if(isset($UserDetails->contactNum) && !empty($UserDetails->contactNum))
                                    <li class="mb-2"><i class="fas fa-phone text-primary me-2"></i> {{ $UserDetails->contactNum }}</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    @if(isset($UserDetails->address) && !empty($UserDetails->address))
                                    <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $UserDetails->address }}</li>
                                    @endif
                                    <li class="mb-2"><i class="fas fa-calendar text-primary me-2"></i> Available for projects</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="modern-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">Skills & Expertise</div>
                <h2 class="section-title">Technologies I Love</h2>
                <p class="section-description">
                    Constantly learning and mastering new technologies to stay ahead of the curve
                </p>
            </div>
            @if(isset($UserDetails->action) && is_array($UserDetails->action))
            <div class="row g-4">
                @foreach($UserDetails->action as $index => $skill)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="skill-item">
                        <div class="skill-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h5 class="mb-3">{{ $skill }}</h5>
                        @if(isset($UserDetails->professional_skills_parcent[$index]))
                        <div class="progress" style="height: 6px; background: rgba(255,255,255,0.1);">
                            <div class="progress-bar" style="background: var(--primary-gradient); width: {{ $UserDetails->professional_skills_parcent[$index] }}%"></div>
                        </div>
                        <small class="text-muted">{{ $UserDetails->professional_skills_parcent[$index] }}%</small>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Professional Skills Section -->
    <section class="modern-section" style="padding-top: 60px;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">Professional Skills</div>
                <h2 class="section-title">Soft Skills & Competencies</h2>
                <p class="section-description">
                    Core professional skills that drive success in collaborative environments
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="professional-skills-grid" data-aos="fade-up" data-aos-delay="200">
                        @php
                            $professionalSkills = [
                                'communication' => ['label' => 'Communication', 'icon' => 'fas fa-comments'],
                                'team_work' => ['label' => 'Team Work', 'icon' => 'fas fa-users'],
                                'project_management' => ['label' => 'Project Management', 'icon' => 'fas fa-tasks'],
                                'creativity' => ['label' => 'Creativity', 'icon' => 'fas fa-lightbulb'],
                                'team_management' => ['label' => 'Team Management', 'icon' => 'fas fa-user-tie'],
                                'active_participation' => ['label' => 'Active Participation', 'icon' => 'fas fa-hand-paper']
                            ];
                        @endphp

                        @foreach($professionalSkills as $key => $skill)
                            @if(isset($UserDetails->$key) && $UserDetails->$key)
                            <div class="professional-skill-item" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 150 }}">
                                <div class="skill-circle-container">
                                    <div class="skill-circle" data-percentage="{{ $UserDetails->$key }}">
                                        <svg class="skill-circle-svg" width="120" height="120">
                                            <circle cx="60" cy="60" r="50" class="skill-circle-bg"></circle>
                                            <circle cx="60" cy="60" r="50" class="skill-circle-progress"
                                                    style="stroke-dasharray: {{ 2 * 3.14159 * 50 }};
                                                           stroke-dashoffset: {{ 2 * 3.14159 * 50 * (100 - $UserDetails->$key) / 100 }};">
                                            </circle>
                                        </svg>
                                        <div class="skill-circle-content">
                                            <div class="skill-icon">
                                                <i class="{{ $skill['icon'] }}"></i>
                                            </div>
                                            <div class="skill-percentage">{{ $UserDetails->$key }}%</div>
                                        </div>
                                    </div>
                                    <h6 class="skill-label">{{ $skill['label'] }}</h6>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .professional-skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            padding: 20px;
        }

        .professional-skill-item {
            text-align: center;
        }

        .skill-circle-container {
            position: relative;
            display: inline-block;
        }

        .skill-circle {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
        }

        .skill-circle-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .skill-icon {
            font-size: 24px;
            color: var(--text-primary);
            margin-bottom: 5px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .skill-percentage {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .skill-circle-svg {
            position: absolute;
            top: 0;
            left: 0;
            transform: rotate(-90deg);
            z-index: 1;
        }

        .skill-circle-bg {
            fill: none;
            stroke: rgba(255, 255, 255, 0.1);
            stroke-width: 4;
        }

        .skill-circle-progress {
            fill: none;
            stroke: url(#skillGradient);
            stroke-width: 4;
            stroke-linecap: round;
            transition: stroke-dashoffset 2s ease-in-out;
        }

        .skill-label {
            color: var(--text-primary);
            font-weight: 600;
            margin: 0;
            font-size: 14px;
        }

        .professional-skill-item:hover .skill-circle {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .professional-skill-item:hover .skill-icon {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @media (max-width: 768px) {
            .professional-skills-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .skill-circle {
                width: 100px;
                height: 100px;
            }

            .skill-circle-svg {
                width: 100px;
                height: 100px;
            }

            .skill-circle-svg circle {
                r: 40;
                cx: 50;
                cy: 50;
            }

            .skill-icon {
                font-size: 20px;
            }

            .skill-percentage {
                font-size: 14px;
            }
        }
    </style>    <!-- SVG Gradient Definition -->
    <svg style="position: absolute; width: 0; height: 0;">
        <defs>
            <linearGradient id="skillGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#667eea;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#764ba2;stop-opacity:1" />
            </linearGradient>
        </defs>
    </svg>

    <!-- Experience Section -->
    <section id="experience" class="modern-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">Experience</div>
                <h2 class="section-title">Professional Journey</h2>
                <p class="section-description">
                    A timeline of my professional growth and achievements
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    @if($EducationDetails && $EducationDetails->count() > 0)
                    <h4 class="mb-4">Education</h4>
                    <div class="timeline">
                        @foreach($EducationDetails as $education)
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <h5>{{ $education->degree }}</h5>
                                <p class="text-primary mb-1">{{ $education->university }}</p>
                                <small class="text-muted">{{ $education->from_date }} - {{ $education->to_date }}</small>
                                @if($education->description)
                                <p class="mt-2 mb-0">{{ $education->description }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    @if($WorkExperiences && $WorkExperiences->count() > 0)
                    <h4 class="mb-4">Work Experience</h4>
                    <div class="timeline">
                        @foreach($WorkExperiences as $work)
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <h5>{{ $work->position }}</h5>
                                <p class="text-primary mb-1">{{ $work->organization }}</p>
                                <small class="text-muted">
                                    {{ $work->from_date }} -
                                    @if($work->to_date)
                                        {{ $work->to_date }}
                                    @else
                                        Present
                                    @endif
                                </small>
                                @if($work->roles_and_responsibilities)
                                <p class="mt-2 mb-0">{{ $work->roles_and_responsibilities }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Blogs Section -->
    @if($blogs && $blogs->count() > 0)
    <section id="blogs" class="modern-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">Latest Insights</div>
                <h2 class="section-title">Blog & Articles</h2>
                <p class="section-description">
                    Sharing knowledge and insights from my development journey
                </p>
            </div>
            <div class="row g-4">
                @foreach($blogs->take(6) as $index => $blog)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="glass-card h-100">
                        @if($blog->featured_image)
                        <img src="{{ asset('storage/'.$blog->featured_image) }}" alt="{{ $blog->title }}"
                             class="img-fluid rounded mb-3" style="height: 200px; object-fit: cover; width: 100%;">
                        @endif
                        <h5 class="mb-3">{{ Str::limit($blog->title, 60) }}</h5>
                        <p class="text-muted mb-3">{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $blog->published_at->format('M d, Y') }}</small>
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="modern-btn" style="padding: 8px 16px; font-size: 14px;">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" class="modern-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">Get In Touch</div>
                <h2 class="section-title">Contact Me</h2>
                <p class="section-description">
                    Feel free to reach out for collaborations or just a friendly hello
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="row g-4">
                        <!-- Address -->
                        <div class="col-12">
                            <div class="glass-card">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon me-4">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Address</h5>
                                        <p class="text-primary text-decoration-non">
                                            {{ $UserDetails->address ?? 'Remote / Available Worldwide' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12">
                            <div class="glass-card">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon me-4">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Email</h5>
                                        <a href="mailto:{{ $UserDetails->email }}" class="text-primary text-decoration-none">
                                            {{ $UserDetails->email }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Phone -->
                        @if(isset($UserDetails->contactNum) && !empty($UserDetails->contactNum))
                        <div class="col-12">
                            <div class="glass-card">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon me-4">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Phone</h5>
                                        <a href="tel:{{ $UserDetails->contactNum }}" class="text-primary text-decoration-none">
                                            {{ $UserDetails->contactNum }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Image/Animation -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="contact-visual">
                        <div class="contact-animation">
                            <div class="floating-elements">
                                <div class="floating-element" style="--delay: 0s;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="floating-element" style="--delay: 1s;">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="floating-element" style="--delay: 2s;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="floating-element" style="--delay: 3s;">
                                    <i class="fas fa-comments"></i>
                                </div>
                            </div>
                            <div class="contact-center">
                                <div class="contact-pulse"></div>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-gradient);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .contact-visual {
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-animation {
            position: relative;
            width: 300px;
            height: 300px;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .floating-element {
            position: absolute;
            width: 60px;
            height: 60px;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--text-primary);
            animation: floatingOrbit 6s linear infinite;
            animation-delay: var(--delay);
        }

        .floating-element:nth-child(1) {
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .floating-element:nth-child(2) {
            top: 50%;
            right: 0;
            transform: translateY(-50%);
        }

        .floating-element:nth-child(3) {
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .floating-element:nth-child(4) {
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        @keyframes floatingOrbit {
            0% {
                transform: rotate(0deg) translateX(120px) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: rotate(360deg) translateX(120px) rotate(-360deg);
                opacity: 0.7;
            }
        }

        .contact-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            z-index: 2;
        }

        .contact-pulse {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: var(--primary-gradient);
            animation: pulse 2s ease-in-out infinite;
            opacity: 0.6;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.3;
            }
            100% {
                transform: scale(1);
                opacity: 0.6;
            }
        }
    </style>

    <!-- Footer -->
    <footer class="modern-footer">
        <div class="container">
            <div class="social-links">
                @php
                    $socialLinks = [
                        'linkedin_profile' => ['icon' => 'fab fa-linkedin-in', 'url' => $UserDetails->linkedin_profile ?? null],
                        'github_profile' => ['icon' => 'fab fa-github', 'url' => $UserDetails->github_profile ?? null],
                        'twitter_profile' => ['icon' => 'fab fa-twitter', 'url' => $UserDetails->twitter_profile ?? null],
                        'facebook_profile' => ['icon' => 'fab fa-facebook-f', 'url' => $UserDetails->facebook_profile ?? null],
                        'instagram_profile' => ['icon' => 'fab fa-instagram', 'url' => $UserDetails->instagram_profile ?? null],
                    ];
                @endphp

                @foreach($socialLinks as $platform => $data)
                    @if($data['url'])
                        <a href="{{ $data['url'] }}" target="_blank" class="social-link" title="{{ ucfirst(str_replace('_', ' ', $platform)) }}">
                            <i class="{{ $data['icon'] }}"></i>
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="text-center">
                <p class="text-muted mb-0">&copy; {{ date('Y') }} {{ $UserDetails->name }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Hide loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('pageLoader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);

                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

                // Update active link
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Update active navigation on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your message! I\'ll get back to you soon.');
        });
    </script>
</body>
</html>
