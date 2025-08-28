<!DOCTYPE html>
<html lang="en">
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
            padding: 120px 0 80px;
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

        .contact-form {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            padding: 40px;
            margin-top: -50px;
            position: relative;
            z-index: 3;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 15px;
        }

        .info-card {
            text-align: center;
            padding: 30px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
             <a class="navbar-brand text-primary fw-bold" href="{{ route('home') }}">
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
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-4">
                        Ready to Start Your <span class="text-warning">Tech Journey?</span>
                    </h1>
                    <p class="lead mb-4">
                        Join thousands of tech professionals who are showcasing their skills and sharing knowledge on MeetMyTech.
                        Let's create your professional presence together!
                    </p>
                    <div class="row g-4 mt-4">
                        <div class="col-md-4">
                            <div class="feature-icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h6>Quick Setup</h6>
                            <small>Get started in minutes</small>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h6>Expert Support</h6>
                            <small>We'll guide you every step</small>
                        </div>
                        <div class="col-md-4">
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
    </section>

    <!-- Contact Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="contact-form">
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

                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-dark">Tell Us About Yourself</h2>
                            <p class="text-muted">Help us understand your background so we can create the perfect platform for you</p>
                        </div>

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <!-- First Name -->
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2 text-primary"></i>First Name *
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
                                    <label for="last_name" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2 text-primary"></i>Last Name *
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
                                    <label for="personal_email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope me-2 text-primary"></i>Personal Email *
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
                                    <label for="professional_email" class="form-label fw-semibold">
                                        <i class="fas fa-briefcase me-2 text-primary"></i>Professional Email
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
                                    <label for="current_organization" class="form-label fw-semibold">
                                        <i class="fas fa-building me-2 text-primary"></i>Current Organization *
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
                                    <label for="position" class="form-label fw-semibold">
                                        <i class="fas fa-id-badge me-2 text-primary"></i>Current Position *
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
                                    <label for="technologies" class="form-label fw-semibold">
                                        <i class="fas fa-code me-2 text-primary"></i>Technologies You Work With *
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

                                <!-- Honeypot (Anti-spam) -->
                                @honeypot

                                <!-- Google reCAPTCHA -->
                                <div class="col-12 text-center">
                                    <div class="d-flex justify-content-center">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    @error('g-recaptcha-response')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane me-2"></i>Start My Journey
                                    </button>
                                    <p class="text-muted small mt-3 mb-0">
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
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Quick Response</h5>
                        <p class="text-muted">We respond to all inquiries within 24 hours during business days.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="feature-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h5>Personal Support</h5>
                        <p class="text-muted">Get one-on-one guidance to set up your perfect tech portfolio.</p>
                    </div>
                </div>
                <div class="col-lg-4">
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
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="text-warning mb-0">
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
</body>
</html>
