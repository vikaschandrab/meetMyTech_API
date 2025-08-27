<!DOCTYPE html>
<html lang="en" data-theme="dark">
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
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

        body::after {
            content: '';
            position: fixed;
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
            opacity: 0.4;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.8; }
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
            background: var(--bg-secondary);
            border-radius: 24px;
            box-shadow: var(--shadow-dark), var(--shadow-gold);
            padding: 3rem;
            border: 1px solid var(--border-light);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
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

        .login-card:hover::before {
            opacity: 1;
        }

        @keyframes borderGlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-section img {
            height: 64px;
            width: auto;
            margin-bottom: 1rem;
            filter: brightness(1.2);
        }

        .login-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg,
                var(--text-primary) 0%,
                var(--accent-gold) 50%,
                var(--accent-neon) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-shadow: var(--glow-gold);
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
            color: var(--accent-gold);
            text-shadow: var(--shadow-gold);
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid var(--border-dark);
            padding: 14px 18px;
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
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-dark));
            border: none;
            border-radius: 12px;
            padding: 14px 2rem;
            font-weight: 700;
            font-size: 1rem;
            color: var(--bg-primary);
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-gold);
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

        .forgot-password-link {
            color: var(--accent-gold);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .forgot-password-link:hover {
            color: var(--accent-neon);
            text-shadow: var(--shadow-neon);
            text-decoration: none;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
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
            background: var(--border-dark);
        }

        .divider span {
            background: var(--bg-secondary);
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
            color: var(--accent-gold);
            text-shadow: var(--shadow-gold);
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
            border-color: #ff4757 !important;
        }

        .invalid-feedback {
            color: #ff4757;
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

        /* Glow effects */
        .form-control:focus {
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
        }

        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 0 50px rgba(255, 215, 0, 0.8);
        }
    </style>
</head>
<body>
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

        // Enhanced form interactions with particle effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                createParticles(this);
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Particle effect
        function createParticles(element) {
            const rect = element.getBoundingClientRect();
            for (let i = 0; i < 5; i++) {
                setTimeout(() => {
                    const particle = document.createElement('div');
                    particle.style.cssText = `
                        position: fixed;
                        width: 4px;
                        height: 4px;
                        background: #ffd700;
                        border-radius: 50%;
                        pointer-events: none;
                        left: ${rect.left + Math.random() * rect.width}px;
                        top: ${rect.top + Math.random() * rect.height}px;
                        z-index: 9999;
                        animation: particleFloat 2s ease-out forwards;
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

        // Add particle animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes particleFloat {
                to {
                    opacity: 0;
                    transform: translateY(-100px) scale(0);
                }
            }
        `;
        document.head.appendChild(style);

        // Mouse trail effect
        document.addEventListener('mousemove', function(e) {
            if (Math.random() < 0.1) {
                const trail = document.createElement('div');
                trail.style.cssText = `
                    position: fixed;
                    width: 2px;
                    height: 2px;
                    background: #ffd700;
                    border-radius: 50%;
                    pointer-events: none;
                    left: ${e.clientX}px;
                    top: ${e.clientY}px;
                    z-index: 9999;
                    animation: fadeOut 1s ease-out forwards;
                `;

                document.body.appendChild(trail);

                setTimeout(() => {
                    if (trail.parentNode) {
                        trail.parentNode.removeChild(trail);
                    }
                }, 1000);
            }
        });

        // Add fadeOut animation
        const fadeStyle = document.createElement('style');
        fadeStyle.textContent = `
            @keyframes fadeOut {
                to {
                    opacity: 0;
                    transform: scale(0);
                }
            }
        `;
        document.head.appendChild(fadeStyle);
    </script>
</body>
</html>
