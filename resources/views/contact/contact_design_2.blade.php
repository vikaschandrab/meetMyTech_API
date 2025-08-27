<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Start Your Tech Journey | MeetMyTech</title>
    <meta name="description" content="Ready to showcase your tech journey? Contact MeetMyTech to get started with your professional portfolio and blog platform.">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('meetmytech_favicon.jpg') }}" type="image/jpeg">
    <link rel="shortcut icon" href="{{ asset('meetmytech_favicon.jpg') }}" />

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
            --bg-primary: #0a0a0a;
            --bg-secondary: #141414;
            --bg-tertiary: #1a1a1a;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --text-muted: #666666;
            --accent-gold: #ffd700;
            --accent-gold-dark: #e6c200;
            --accent-neon: #00ff88;
            --accent-purple: #8b5cf6;
            --border-dark: #333333;
            --border-light: #444444;
            --shadow-dark: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            --shadow-neon: 0 0 20px rgba(0, 255, 136, 0.3);
            --shadow-gold: 0 0 30px rgba(255, 215, 0, 0.4);
            --glow-gold: 0 0 40px rgba(255, 215, 0, 0.6);
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
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 25% 25%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(0, 255, 136, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .hero-section {
            background: linear-gradient(135deg,
                var(--bg-secondary) 0%,
                var(--bg-tertiary) 50%,
                var(--bg-primary) 100%);
            padding: 140px 0 100px;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffd700" opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
            background-size: cover;
            background-position: bottom;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 20%;
            left: 10%;
            right: 10%;
            bottom: 20%;
            background:
                radial-gradient(2px 2px at 20px 30px, var(--accent-gold), transparent),
                radial-gradient(2px 2px at 40px 70px, var(--accent-neon), transparent),
                radial-gradient(1px 1px at 90px 40px, var(--accent-purple), transparent);
            background-repeat: repeat;
            background-size: 200px 150px;
            animation: sparkle 4s linear infinite;
            opacity: 0.6;
            pointer-events: none;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg,
                var(--text-primary) 0%,
                var(--accent-gold) 50%,
                var(--accent-neon) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: var(--glow-gold);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            line-height: 1.6;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        .contact-form {
            background: var(--bg-secondary);
            border-radius: 24px;
            box-shadow: var(--shadow-dark), var(--shadow-gold);
            padding: 50px;
            margin-top: -80px;
            position: relative;
            z-index: 3;
            border: 1px solid var(--border-light);
        }

        .contact-form::before {
            content: '';
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            bottom: -1px;
            background: linear-gradient(45deg,
                var(--accent-gold),
                var(--accent-neon),
                var(--accent-purple),
                var(--accent-gold));
            background-size: 400% 400%;
            border-radius: 24px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
            animation: borderGlow 4s ease-in-out infinite;
        }

        .contact-form:hover::before {
            opacity: 1;
        }

        @keyframes borderGlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid var(--border-dark);
            padding: 16px 20px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: var(--shadow-gold);
            outline: none;
            background-color: var(--bg-secondary);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-label i {
            color: var(--accent-gold);
            text-shadow: var(--shadow-gold);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-dark));
            border: none;
            border-radius: 12px;
            padding: 16px 40px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--bg-primary);
            transition: all 0.3s ease;
            box-shadow: var(--shadow-gold);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--glow-gold);
            background: linear-gradient(135deg, var(--accent-gold-dark), var(--accent-gold));
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-neon));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--bg-primary);
            font-size: 2rem;
            margin: 0 auto 20px;
            box-shadow: var(--shadow-gold);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
            opacity: 0;
        }

        .feature-icon:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: var(--glow-gold);
        }

        .feature-icon:hover::before {
            opacity: 1;
            animation: shimmer 1.5s ease-in-out;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .hero-feature {
            text-align: center;
            padding: 20px;
        }

        .hero-feature h6 {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--accent-gold);
        }

        .hero-feature small {
            color: var(--text-secondary);
        }

        .info-card {
            text-align: center;
            padding: 40px 30px;
            background: var(--bg-secondary);
            border-radius: 20px;
            box-shadow: var(--shadow-dark);
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid var(--border-dark);
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-gold), var(--accent-neon));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-dark), var(--shadow-neon);
            border-color: var(--accent-gold);
        }

        .info-card:hover::before {
            transform: scaleX(1);
        }

        .info-card .feature-icon {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 16px 24px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, var(--accent-neon), #00cc70);
            color: var(--bg-primary);
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff4757, #ff3838);
            color: white;
        }

        .navbar {
            background: rgba(20, 20, 20, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-dark);
            border-bottom: 1px solid var(--border-dark);
        }

        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-secondary) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-gold) !important;
            text-shadow: var(--shadow-gold);
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-primary), var(--accent-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
        }

        .info-section {
            padding: 100px 0;
            background: var(--bg-secondary);
            position: relative;
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 215, 0, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(0, 255, 136, 0.05) 0%, transparent 50%);
        }

        .footer {
            background: var(--bg-primary);
            color: var(--text-primary);
            padding: 60px 0 30px;
            border-top: 1px solid var(--border-dark);
        }

        .footer h6 {
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-neon));
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--accent-neon), var(--accent-gold));
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .contact-form {
                padding: 30px 25px;
                margin-top: -50px;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('meetmytech_logo.jpg') }}" alt="MeetMyTech" style="height: 32px; width: auto; margin-right: 8px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.all-blogs') }}">All Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                    <h1 class="hero-title">
                        Ready to Start Your Tech Journey?
                    </h1>
                    <p class="hero-subtitle">
                        Join thousands of tech professionals who are showcasing their skills and sharing knowledge on MeetMyTech.
                        Let's create your professional presence together!
                    </p>
                    <div class="row g-4 mt-4">
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="hero-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <h6>Quick Setup</h6>
                                <small>Get started in minutes</small>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="hero-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h6>Expert Support</h6>
                                <small>We'll guide you every step</small>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="hero-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-crown"></i>
                                </div>
                                <h6>Premium Features</h6>
                                <small>Professional tools included</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="contact-form" data-aos="fade-up">
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success mb-4">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger mb-4">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="text-center mb-5">
                            <h2 class="section-title">Tell Us About Yourself</h2>
                            <p class="section-subtitle">Help us understand your background so we can create the perfect platform for you</p>
                        </div>

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf

                            <div class="row g-4">
                                <!-- First Name -->
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">
                                        <i class="fas fa-user me-2"></i>First Name *
                                    </label>
                                    <input type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           id="first_name"
                                           name="first_name"
                                           value="{{ old('first_name') }}"
                                           required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">
                                        <i class="fas fa-user me-2"></i>Last Name *
                                    </label>
                                    <input type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           id="last_name"
                                           name="last_name"
                                           value="{{ old('last_name') }}"
                                           required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Personal Email -->
                                <div class="col-md-6">
                                    <label for="personal_email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Personal Email *
                                    </label>
                                    <input type="email"
                                           class="form-control @error('personal_email') is-invalid @enderror"
                                           id="personal_email"
                                           name="personal_email"
                                           value="{{ old('personal_email') }}"
                                           required>
                                    @error('personal_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Professional Email -->
                                <div class="col-md-6">
                                    <label for="professional_email" class="form-label">
                                        <i class="fas fa-briefcase me-2"></i>Professional Email
                                    </label>
                                    <input type="email"
                                           class="form-control @error('professional_email') is-invalid @enderror"
                                           id="professional_email"
                                           name="professional_email"
                                           value="{{ old('professional_email') }}"
                                           placeholder="If different from personal">
                                    @error('professional_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Current Organization -->
                                <div class="col-md-6">
                                    <label for="current_organization" class="form-label">
                                        <i class="fas fa-building me-2"></i>Current Organization *
                                    </label>
                                    <input type="text"
                                           class="form-control @error('current_organization') is-invalid @enderror"
                                           id="current_organization"
                                           name="current_organization"
                                           value="{{ old('current_organization') }}"
                                           placeholder="Company, Freelancer, Student, etc."
                                           required>
                                    @error('current_organization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Position -->
                                <div class="col-md-6">
                                    <label for="position" class="form-label">
                                        <i class="fas fa-id-badge me-2"></i>Current Position *
                                    </label>
                                    <input type="text"
                                           class="form-control @error('position') is-invalid @enderror"
                                           id="position"
                                           name="position"
                                           value="{{ old('position') }}"
                                           placeholder="e.g., Senior Developer, Student, CEO"
                                           required>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Technologies -->
                                <div class="col-12">
                                    <label for="technologies" class="form-label">
                                        <i class="fas fa-code me-2"></i>Technologies You Work With *
                                    </label>
                                    <textarea class="form-control @error('technologies') is-invalid @enderror"
                                              id="technologies"
                                              name="technologies"
                                              rows="4"
                                              placeholder="e.g., JavaScript, Python, React, Laravel, AWS, Docker, etc. Tell us about your tech stack and what you're passionate about."
                                              required>{{ old('technologies') }}</textarea>
                                    @error('technologies')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-center mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane me-2"></i>Start My Journey
                                    </button>
                                    <p class="text-muted mt-3 mb-0">
                                        We'll get back to you within 24 hours with next steps!
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Cards Section -->
    <section class="info-section">
        <div class="container position-relative">
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Quick Response</h5>
                        <p class="text-muted">We respond to all inquiries within 24 hours during business days.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card">
                        <div class="feature-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h5>Personal Support</h5>
                        <p class="text-muted">Get one-on-one guidance to set up your perfect tech portfolio.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="info-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Privacy First</h5>
                        <p class="text-muted">Your information is secure and will only be used to contact you about MeetMyTech.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="mb-2">
                        <i class="fas fa-code me-2"></i>MeetMyTech
                    </h6>
                    <small class="text-muted">Empowering tech professionals worldwide</small>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-muted">
                        © {{ date('Y') }} MeetMyTech. Built with ❤️ for the tech community.
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
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });

        // Enhanced form interactions
        const form = document.querySelector('form');
        const inputs = document.querySelectorAll('.form-control');

        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
                this.style.boxShadow = '0 0 30px rgba(255, 215, 0, 0.4)';
            });

            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = '';
            });

            // Typing effect
            input.addEventListener('input', function() {
                this.style.borderColor = '#ffd700';
                setTimeout(() => {
                    if (!this.matches(':focus')) {
                        this.style.borderColor = '';
                    }
                }, 300);
            });
        });

        // Particle effect on mouse move
        document.addEventListener('mousemove', function(e) {
            const particle = document.createElement('div');
            particle.style.cssText = `
                position: fixed;
                width: 4px;
                height: 4px;
                background: #ffd700;
                border-radius: 50%;
                pointer-events: none;
                left: ${e.clientX}px;
                top: ${e.clientY}px;
                opacity: 0.8;
                z-index: 9999;
                animation: fadeOut 1s ease-out forwards;
            `;

            document.body.appendChild(particle);

            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, 1000);
        });

        // Add fadeOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                to {
                    opacity: 0;
                    transform: scale(0) translateY(-50px);
                }
            }
        `;
        document.head.appendChild(style);

        // Smooth scrolling
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
    </script>
</body>
</html>
