<!DOCTYPE html>
<html lang="en" data-theme="glass">
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
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.8);
            --text-muted: rgba(255, 255, 255, 0.6);
            --holo-primary: #667eea;
            --holo-secondary: #764ba2;
            --holo-tertiary: #f093fb;
            --holo-quaternary: #f5576c;
            --accent-neon: #00d9ff;
            --accent-purple: #c471ed;
            --accent-pink: #f64f59;
            --shadow-glow: 0 8px 32px rgba(31, 38, 135, 0.37);
            --shadow-intense: 0 8px 32px rgba(31, 38, 135, 0.6);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg,
                #667eea 0%,
                #764ba2 25%,
                #f093fb 50%,
                #f5576c 75%,
                #4facfe 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            color: var(--text-primary);
            line-height: 1.7;
            overflow-x: hidden;
            min-height: 100vh;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-glow);
            transition: all 0.4s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.15);
            box-shadow: var(--shadow-intense);
            transform: translateY(-5px);
        }

        .hero-section {
            position: relative;
            padding: 140px 0 100px;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(1px);
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 20%;
            left: 10%;
            right: 10%;
            bottom: 20%;
            background-image:
                radial-gradient(2px 2px at 20px 30px, rgba(255, 255, 255, 0.3), transparent),
                radial-gradient(2px 2px at 40px 70px, rgba(0, 217, 255, 0.3), transparent),
                radial-gradient(1px 1px at 90px 40px, rgba(196, 113, 237, 0.3), transparent),
                radial-gradient(1px 1px at 130px 80px, rgba(255, 255, 255, 0.2), transparent);
            background-repeat: repeat;
            background-size: 200px 150px;
            animation: float 6s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes float {
            from { transform: translateY(0px); }
            to { transform: translateY(-20px); }
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
                var(--accent-neon) 50%,
                var(--accent-purple) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            margin-bottom: 2rem;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .contact-form {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-intense);
            padding: 50px;
            margin-top: -80px;
            position: relative;
            z-index: 3;
        }

        .contact-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                rgba(255, 255, 255, 0.1) 0%,
                rgba(0, 217, 255, 0.1) 50%,
                rgba(196, 113, 237, 0.1) 100%);
            border-radius: 24px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .contact-form:hover::before {
            opacity: 1;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid var(--glass-border);
            padding: 16px 20px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: var(--text-primary);
        }

        .form-control:focus {
            border-color: var(--accent-neon);
            box-shadow: 0 0 0 0.2rem rgba(0, 217, 255, 0.25);
            outline: none;
            background: rgba(255, 255, 255, 0.15);
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
            color: var(--accent-neon);
            text-shadow: 0 0 10px rgba(0, 217, 255, 0.5);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-neon), var(--accent-purple));
            border: none;
            border-radius: 12px;
            padding: 16px 40px;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 217, 255, 0.4);
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
            box-shadow: 0 15px 35px rgba(0, 217, 255, 0.6);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--accent-neon), var(--accent-purple));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 20px;
            box-shadow: 0 15px 35px rgba(0, 217, 255, 0.4);
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
            transform: translateY(-5px) scale(1.05) rotateY(10deg);
            box-shadow: 0 20px 40px rgba(0, 217, 255, 0.6);
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
            color: var(--accent-neon);
        }

        .hero-feature small {
            color: var(--text-secondary);
        }

        .info-card {
            text-align: center;
            padding: 40px 30px;
            height: 100%;
            transition: all 0.3s ease;
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
            background: linear-gradient(90deg, var(--accent-neon), var(--accent-purple));
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
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.8);
            color: white;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.8);
            color: white;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .navbar {
            backdrop-filter: blur(20px);
            background: var(--glass-bg) !important;
            border-bottom: 1px solid var(--glass-border);
        }

        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--accent-neon), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-neon) !important;
            text-shadow: 0 0 10px rgba(0, 217, 255, 0.5);
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-primary), var(--accent-neon));
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
            position: relative;
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(2px);
        }

        .footer {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            color: var(--text-primary);
            padding: 60px 0 30px;
            border-top: 1px solid var(--glass-border);
        }

        .footer h6 {
            background: linear-gradient(135deg, var(--accent-neon), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Holographic effects */
        .holo-effect {
            position: relative;
            overflow: hidden;
        }

        .holo-effect::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent,
                rgba(0, 217, 255, 0.1),
                transparent);
            transform: rotate(45deg);
            animation: holographic 3s linear infinite;
            pointer-events: none;
        }

        @keyframes holographic {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        /* Interactive cursor effect */
        .glass-interactive {
            transition: all 0.3s ease;
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
    <section class="hero-section holo-effect">
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                    <h1 class="hero-title">
                        Ready to Start Your <span style="background: linear-gradient(135deg, var(--accent-neon), var(--accent-pink)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tech Journey?</span>
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
                    <div class="contact-form glass-interactive" data-aos="fade-up">
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
                    <div class="info-card glass-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Quick Response</h5>
                        <p class="text-muted">We respond to all inquiries within 24 hours during business days.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card glass-card">
                        <div class="feature-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h5>Personal Support</h5>
                        <p class="text-muted">Get one-on-one guidance to set up your perfect tech portfolio.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="info-card glass-card">
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

        // Enhanced glassmorphism effects
        document.querySelectorAll('.glass-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.background = 'rgba(255, 255, 255, 0.15)';
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.background = 'rgba(255, 255, 255, 0.1)';
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Interactive cursor effect for glass elements
        document.addEventListener('mousemove', function(e) {
            const glassElements = document.querySelectorAll('.glass-interactive');
            const mouseX = e.clientX;
            const mouseY = e.clientY;

            glassElements.forEach((element, index) => {
                const rect = element.getBoundingClientRect();
                const elementX = rect.left + rect.width / 2;
                const elementY = rect.top + rect.height / 2;

                const deltaX = (mouseX - elementX) / 50;
                const deltaY = (mouseY - elementY) / 50;

                element.style.transform = `perspective(1000px) rotateX(${deltaY}deg) rotateY(${deltaX}deg)`;
            });
        });

        // Form interactions with glassmorphism effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.background = 'rgba(255, 255, 255, 0.15)';
                this.style.transform = 'scale(1.02)';
                this.style.boxShadow = '0 0 20px rgba(0, 217, 255, 0.4)';
            });

            input.addEventListener('blur', function() {
                this.style.background = 'rgba(255, 255, 255, 0.1)';
                this.style.transform = 'scale(1)';
                this.style.boxShadow = '';
            });
        });

        // Parallax effect for background
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('body');
            const speed = scrolled * 0.5;

            parallax.style.backgroundPosition = `50% ${speed}px`;
        });

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

        // Dynamic particle creation on form interaction
        const form = document.querySelector('form');
        form.addEventListener('input', function(e) {
            if (Math.random() < 0.1) { // 10% chance to create particle
                createParticle(e.target);
            }
        });

        function createParticle(element) {
            const particle = document.createElement('div');
            const rect = element.getBoundingClientRect();

            particle.style.cssText = `
                position: fixed;
                width: 6px;
                height: 6px;
                background: linear-gradient(45deg, #00d9ff, #c471ed);
                border-radius: 50%;
                pointer-events: none;
                left: ${rect.left + Math.random() * rect.width}px;
                top: ${rect.top + Math.random() * rect.height}px;
                z-index: 9999;
                animation: floatAway 2s ease-out forwards;
            `;

            document.body.appendChild(particle);

            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, 2000);
        }

        // Add floatAway animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes floatAway {
                to {
                    opacity: 0;
                    transform: translateY(-100px) scale(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
