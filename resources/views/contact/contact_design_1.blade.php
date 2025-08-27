<!DOCTYPE html>
<html lang="en" data-theme="light">
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
            --primary-blue: #2563eb;
            --primary-blue-dark: #1e40af;
            --accent-orange: #f59e0b;
            --accent-orange-light: #fbbf24;
            --text-dark: #1f2937;
            --text-gray: #6b7280;
            --text-light: #9ca3af;
            --bg-light: #f8fafc;
            --bg-white: #ffffff;
            --border-light: #e5e7eb;
            --success-green: #10b981;
            --error-red: #ef4444;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--bg-light);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-dark) 100%);
            color: white;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
            background-size: cover;
            background-position: bottom;
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

        .hero-title .text-highlight {
            color: var(--accent-orange);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .contact-form {
            background: var(--bg-white);
            border-radius: 24px;
            box-shadow: var(--shadow-xl);
            padding: 50px;
            margin-top: -80px;
            position: relative;
            z-index: 3;
            border: 1px solid var(--border-light);
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid var(--border-light);
            padding: 16px 20px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background-color: var(--bg-white);
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .form-label i {
            color: var(--primary-blue);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-dark));
            border: none;
            border-radius: 12px;
            padding: 16px 40px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(135deg, var(--primary-blue-dark), var(--primary-blue));
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-orange));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 20px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .feature-icon:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .hero-feature {
            text-align: center;
            padding: 20px;
        }

        .hero-feature h6 {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .hero-feature small {
            opacity: 0.8;
        }

        .info-card {
            text-align: center;
            padding: 40px 30px;
            background: var(--bg-white);
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid var(--border-light);
        }

        .info-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
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
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, var(--error-red), #dc2626);
            color: white;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-sm);
        }

        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-blue) !important;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-dark) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-blue) !important;
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 3rem;
        }

        .info-section {
            padding: 100px 0;
            background: var(--bg-white);
        }

        .footer {
            background: var(--text-dark);
            color: white;
            padding: 60px 0 30px;
        }

        .footer h6 {
            color: var(--accent-orange);
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

        /* Animation enhancements */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in-up.animate {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
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
                        Ready to Start Your <span class="text-highlight">Tech Journey?</span>
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
        <div class="container">
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

        // Smooth scrolling for internal links
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

        // Form validation enhancements
        const form = document.querySelector('form');
        const inputs = document.querySelectorAll('.form-control');

        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
