<!DOCTYPE html>
<html lang="en" data-theme="glassmorphism">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery | MeetMyTech</title>
    <meta name="description" content="Recover your MeetMyTech account password. Secure password reset portal.">

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
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --tertiary-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.8);
            --text-accent: #f0f9ff;
            --shadow-glass: 0 8px 32px rgba(31, 38, 135, 0.37);
            --shadow-hover: 0 15px 40px rgba(31, 38, 135, 0.5);
            --success-gradient: linear-gradient(135deg, #10b981, #059669);
            --danger-gradient: linear-gradient(135deg, #ef4444, #dc2626);
            --info-gradient: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow-x: hidden;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Orbs */
        .floating-orbs {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            animation: float 6s ease-in-out infinite;
        }

        .orb-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .orb-3 {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .orb-4 {
            width: 100px;
            height: 100px;
            top: 30%;
            right: 30%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) translateX(0px) rotate(0deg);
                opacity: 0.7;
            }
            25% {
                transform: translateY(-30px) translateX(15px) rotate(90deg);
                opacity: 1;
            }
            50% {
                transform: translateY(-60px) translateX(-10px) rotate(180deg);
                opacity: 0.8;
            }
            75% {
                transform: translateY(-30px) translateX(-20px) rotate(270deg);
                opacity: 1;
            }
        }

        /* Holographic Lines */
        .holo-lines {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 2;
            opacity: 0.1;
        }

        .holo-line {
            position: absolute;
            background: linear-gradient(90deg, transparent, var(--text-primary), transparent);
            height: 1px;
            width: 100%;
            animation: scan 4s linear infinite;
        }

        .holo-line:nth-child(1) { top: 20%; animation-delay: 0s; }
        .holo-line:nth-child(2) { top: 50%; animation-delay: 1s; }
        .holo-line:nth-child(3) { top: 80%; animation-delay: 2s; }

        @keyframes scan {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .forgot-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            padding: 2rem;
        }

        .forgot-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: var(--shadow-glass);
            padding: 3rem;
            border: 1px solid var(--glass-border);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .forgot-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-5px);
        }

        .forgot-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary-gradient);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-section img {
            height: 64px;
            width: auto;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.3));
            transition: all 0.3s ease;
        }

        .logo-section img:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 0 30px rgba(255, 255, 255, 0.5));
        }

        .forgot-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            animation: titlePulse 3s ease-in-out infinite;
        }

        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .forgot-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 0;
            line-height: 1.6;
            font-weight: 300;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Space Grotesk', sans-serif;
        }

        .form-label i {
            background: var(--secondary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.3));
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 16px 20px;
            font-size: 1rem;
            font-weight: 400;
            color: var(--text-primary);
            transition: all 0.3s ease;
            position: relative;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
            outline: none;
            color: var(--text-primary);
            transform: translateY(-3px);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            font-style: italic;
        }

        /* Input floating effect */
        .form-control:focus + .floating-label,
        .form-control:not(:placeholder-shown) + .floating-label {
            transform: translateY(-25px) scale(0.8);
            color: var(--text-accent);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 16px;
            padding: 16px 2rem;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            color: var(--text-primary);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Space Grotesk', sans-serif;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-gradient);
            box-shadow: 0 15px 40px rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
            color: var(--text-primary);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .back-link {
            background: var(--tertiary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .back-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--tertiary-gradient);
            transition: width 0.3s ease;
        }

        .back-link:hover {
            transform: scale(1.05);
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .back-link:hover::after {
            width: 100%;
        }

        .alert {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 16px;
            border: 1px solid var(--glass-border);
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .alert-success {
            color: var(--text-primary);
        }

        .alert-success::before {
            background: var(--success-gradient);
        }

        .alert-danger {
            color: var(--text-primary);
        }

        .alert-danger::before {
            background: var(--danger-gradient);
        }

        .alert-info {
            color: var(--text-primary);
        }

        .alert-info::before {
            background: var(--info-gradient);
        }

        .security-notice {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 2rem;
            position: relative;
            overflow: hidden;
        }

        .security-notice::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary-gradient);
            animation: securityScan 3s linear infinite;
        }

        @keyframes securityScan {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
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
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-home a:hover {
            color: var(--text-primary);
            transform: scale(1.05);
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .forgot-container {
                padding: 1rem;
            }

            .forgot-card {
                padding: 2rem 1.5rem;
            }

            .forgot-title {
                font-size: 1.8rem;
            }
        }

        /* Form validation styles */
        .is-invalid {
            border-color: rgba(239, 68, 68, 0.5) !important;
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.3) !important;
        }

        .invalid-feedback {
            color: #ff6b6b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            font-weight: 500;
        }

        /* Animations */
        .form-group {
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .forgot-card {
            animation: glassAppear 1s ease forwards;
            opacity: 0;
            transform: scale(0.8) rotateY(10deg);
        }

        @keyframes glassAppear {
            to {
                opacity: 1;
                transform: scale(1) rotateY(0deg);
            }
        }

        /* Interactive 3D effects */
        .forgot-card {
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .form-control:focus {
            transform: translateY(-3px) rotateX(2deg);
        }

        .btn-primary:hover {
            transform: translateY(-3px) rotateX(-2deg);
        }

        /* Holographic scanning effect */
        .forgot-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: holoScan 5s linear infinite;
            pointer-events: none;
        }

        @keyframes holoScan {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>
</head>
<body>
    <!-- Floating Orbs -->
    <div class="floating-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="orb orb-4"></div>
    </div>

    <!-- Holographic Lines -->
    <div class="holo-lines">
        <div class="holo-line"></div>
        <div class="holo-line"></div>
        <div class="holo-line"></div>
    </div>

    <div class="container">
        <div class="forgot-container">
            <div class="forgot-card">
                <!-- Logo Section -->
                <div class="logo-section">
                    <img src="{{ asset('meetmytech_logo.jpg') }}" alt="MeetMyTech">
                    <h1 class="forgot-title">{{ __('Password Recovery') }}</h1>
                    <p class="forgot-subtitle">{{ __("Enter your email address to receive a secure password reset link.") }}</p>
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
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <!-- Forgot Password Form -->
                <form method="POST" action="{{ route('forgot-password.submit') }}" class="needs-validation" novalidate>
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i>
                            {{ __('Email Address') }}
                        </label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter your registered email address"
                               required>
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-shield-halved me-2"></i>{{ __('Recover Password') }}
                        </button>
                    </div>

                    <!-- Back to Login -->
                    <div class="text-center">
                        <p class="text-muted mb-0" style="color: var(--text-secondary) !important;">
                            {{ __('Remembered your password?') }}
                            <a href="{{ route('login') }}" class="back-link">
                                {{ __('Sign In Here') }}
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Security Notice -->
                <div class="security-notice">
                    <i class="fas fa-lock text-primary me-2" style="color: var(--text-accent) !important;"></i>
                    <small style="color: var(--text-secondary);">
                        <strong style="color: var(--text-primary);">Secure Recovery:</strong>
                        We'll send a new password to your email address. For enhanced security,
                        we recommend updating your password immediately after signing in.
                    </small>
                </div>

                <!-- Back to Home -->
                <div class="back-home">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i>
                        <span>Return to Homepage</span>
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

        // Auto-hide alerts with glassmorphism effect
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px) scale(0.95)';
                    alert.style.filter = 'blur(5px)';
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.parentNode.removeChild(alert);
                        }
                    }, 400);
                }, 5000);
            });
        });

        // Enhanced form interactions with 3D effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02) rotateX(2deg)';
                this.style.background = 'rgba(255, 255, 255, 0.2)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1) rotateX(0deg)';
                this.style.background = 'rgba(255, 255, 255, 0.1)';
            });

            // Typing glow effect
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.style.boxShadow = '0 0 40px rgba(255, 255, 255, 0.3), inset 0 0 20px rgba(255, 255, 255, 0.1)';
                } else {
                    this.style.boxShadow = '0 0 30px rgba(255, 255, 255, 0.2)';
                }
            });
        });

        // Button interactive effects
        const button = document.querySelector('.btn-primary');
        button.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 20px 50px rgba(255, 255, 255, 0.4)';
            this.style.transform = 'translateY(-5px) rotateX(-3deg)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 15px 40px rgba(255, 255, 255, 0.3)';
            this.style.transform = 'translateY(-3px) rotateX(-2deg)';
        });

        // Card 3D tilt effect
        const card = document.querySelector('.forgot-card');
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
        });

        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
        });

        // Random orb movement enhancement
        document.querySelectorAll('.orb').forEach(orb => {
            setInterval(() => {
                const randomX = Math.random() * 50 - 25;
                const randomY = Math.random() * 50 - 25;
                orb.style.transform += ` translate(${randomX}px, ${randomY}px)`;
            }, 3000);
        });
    </script>
</body>
</html>
