<!DOCTYPE html>
<html lang="en" data-theme="glass">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | MeetMyTech</title>
    <meta name="description" content="Sign in to your MeetMyTech account to access your dashboard and manage your professional profile.">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('meetmytech_favicon.jpg') }}" type="image/jpeg">
    <link rel="shortcut icon" href="{{ asset('meetmytech_favicon.jpg') }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow-x: hidden;
            overflow-y: auto;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(2px 2px at 20px 30px, rgba(255, 255, 255, 0.3), transparent),
                radial-gradient(2px 2px at 40px 70px, rgba(0, 217, 255, 0.3), transparent),
                radial-gradient(1px 1px at 90px 40px, rgba(196, 113, 237, 0.3), transparent),
                radial-gradient(1px 1px at 130px 80px, rgba(255, 255, 255, 0.2), transparent);
            background-repeat: repeat;
            background-size: 200px 150px;
            animation: float 6s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes float {
            from { transform: translateY(0px); }
            to { transform: translateY(-20px); }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
        }

        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-intense);
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
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

        .login-card:hover::before {
            opacity: 1;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-section img {
            height: 64px;
            width: auto;
            margin-bottom: 1rem;
            filter: brightness(1.1);
        }

        .login-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg,
                var(--text-primary) 0%,
                var(--accent-neon) 50%,
                var(--accent-purple) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: var(--accent-neon);
            text-shadow: 0 0 10px rgba(0, 217, 255, 0.5);
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid var(--glass-border);
            padding: 14px 18px;
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
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-neon), var(--accent-purple));
            border: none;
            border-radius: 12px;
            padding: 14px 2rem;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 217, 255, 0.4);
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

        .forgot-password-link {
            color: var(--accent-neon);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .forgot-password-link:hover {
            color: var(--accent-purple);
            text-shadow: 0 0 10px rgba(196, 113, 237, 0.5);
            text-decoration: none;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
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

        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--glass-border);
        }

        .divider span {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            padding: 0 1rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .back-home {
            text-align: center;
            margin-top: 2rem;
        }

        .back-home a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            color: var(--accent-neon);
            text-shadow: 0 0 10px rgba(0, 217, 255, 0.5);
        }

        @media (max-width: 576px) {
            body {
                align-items: flex-start;
                padding: 1rem 0;
            }
            
            .login-container {
                padding: 1rem;
            }

            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.75rem;
            }
        }

        /* Form validation styles */
        .is-invalid {
            border-color: rgba(239, 68, 68, 0.8) !important;
        }

        .invalid-feedback {
            color: rgba(239, 68, 68, 0.9);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Animation for form elements */
        .form-group {
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            animation: fadeInScale 0.8s ease forwards;
            opacity: 0;
            transform: scale(0.9);
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
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
    </style>
</head>
<body class="holo-effect">
    <div class="container">
        <div class="login-container">
            <div class="login-card">
                <!-- Logo Section -->
                <div class="logo-section">
                    <img src="{{ asset('meetmytech_logo.jpg') }}" alt="MeetMyTech">
                    <h1 class="login-title">{{ __('auth.welcome_back') }}</h1>
                    <p class="login-subtitle">{{ __('auth.sign_in_message') }}</p>
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login.submit') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i>
                            {{ __('auth.email_address') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('auth.enter_email') }}"
                            required
                            autocomplete="email"
                            autofocus
                        />
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i>
                            {{ __('auth.password_label') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            type="password"
                            name="password"
                            placeholder="{{ __('auth.enter_password') }}"
                            required
                            autocomplete="current-password"
                        />
                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            {{ __('Sign In') }}
                        </button>
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="text-center">
                        <a href="{{ route('forgot-password') }}" class="forgot-password-link">
                            <i class="fas fa-key me-1"></i>
                            {{ __('auth.forgot_password') }}
                        </a>
                    </div>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <span>or</span>
                </div>

                <!-- Back to Home -->
                <div class="back-home">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.parentNode.removeChild(alert);
                        }
                    }, 300);
                }, 5000);
            });
        });

        // Enhanced glassmorphism interactions
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.background = 'rgba(255, 255, 255, 0.15)';
                this.style.transform = 'scale(1.02) translateY(-2px)';
                this.style.boxShadow = '0 0 20px rgba(0, 217, 255, 0.4)';
                this.parentElement.style.transform = 'scale(1.02)';
                createGlassParticles(this);
            });

            input.addEventListener('blur', function() {
                this.style.background = 'rgba(255, 255, 255, 0.1)';
                this.style.transform = 'scale(1)';
                this.style.boxShadow = '';
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Glass particle effect
        function createGlassParticles(element) {
            const rect = element.getBoundingClientRect();
            for (let i = 0; i < 6; i++) {
                setTimeout(() => {
                    const particle = document.createElement('div');
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
                        animation: glassFloat 2s ease-out forwards;
                    `;

                    document.body.appendChild(particle);

                    setTimeout(() => {
                        if (particle.parentNode) {
                            particle.parentNode.removeChild(particle);
                        }
                    }, 2000);
                }, i * 100);
            }
        }

        // Interactive cursor effect for glass elements
        document.addEventListener('mousemove', function(e) {
            const card = document.querySelector('.login-card');
            const rect = card.getBoundingClientRect();
            const cardX = rect.left + rect.width / 2;
            const cardY = rect.top + rect.height / 2;

            const deltaX = (e.clientX - cardX) / 30;
            const deltaY = (e.clientY - cardY) / 30;

            card.style.transform = `perspective(1000px) rotateX(${deltaY}deg) rotateY(${deltaX}deg) scale(1)`;
        });

        // Parallax effect for background
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('body');
            const speed = scrolled * 0.5;

            parallax.style.backgroundPosition = `50% ${speed}px`;
        });

        // Add glass particle animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes glassFloat {
                to {
                    opacity: 0;
                    transform: translateY(-100px) scale(0);
                }
            }
        `;
        document.head.appendChild(style);

        // Dynamic background interaction
        document.addEventListener('click', function(e) {
            const ripple = document.createElement('div');
            ripple.style.cssText = `
                position: fixed;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(0, 217, 255, 0.3) 0%, transparent 70%);
                pointer-events: none;
                left: ${e.clientX - 50}px;
                top: ${e.clientY - 50}px;
                width: 100px;
                height: 100px;
                z-index: 0;
                animation: rippleExpand 1s ease-out forwards;
            `;

            document.body.appendChild(ripple);

            setTimeout(() => {
                if (ripple.parentNode) {
                    ripple.parentNode.removeChild(ripple);
                }
            }, 1000);
        });

        // Add ripple animation
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            @keyframes rippleExpand {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(rippleStyle);
    </script>
</body>
</html>
