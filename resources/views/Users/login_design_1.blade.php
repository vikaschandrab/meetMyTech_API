<!DOCTYPE html>
<html lang="en" data-theme="light">
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
            --primary-blue: #2563eb;
            --primary-blue-dark: #1e40af;
            --accent-orange: #f59e0b;
            --text-dark: #1f2937;
            --text-gray: #6b7280;
            --bg-light: #f8fafc;
            --bg-white: #ffffff;
            --border-light: #e5e7eb;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--bg-light) 0%, var(--bg-white) 100%);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23e5e7eb" opacity="0.5"/><circle cx="75" cy="75" r="1" fill="%23e5e7eb" opacity="0.3"/><circle cx="50" cy="10" r="0.5" fill="%232563eb" opacity="0.2"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.1;
            pointer-events: none;
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
            background: var(--bg-white);
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            padding: 3rem;
            border: 1px solid var(--border-light);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--accent-orange));
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-section img {
            height: 64px;
            width: auto;
            margin-bottom: 1rem;
        }

        .login-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: var(--text-gray);
            font-size: 1rem;
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: var(--primary-blue);
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid var(--border-light);
            padding: 14px 18px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background-color: var(--bg-white);
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: var(--text-gray);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-dark));
            border: none;
            border-radius: 12px;
            padding: 14px 2rem;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
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
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, var(--primary-blue-dark), var(--primary-blue));
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .forgot-password-link {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .forgot-password-link:hover {
            color: var(--accent-orange);
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
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
            background: var(--border-light);
        }

        .divider span {
            background: var(--bg-white);
            padding: 0 1rem;
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .back-home {
            text-align: center;
            margin-top: 2rem;
        }

        .back-home a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            color: var(--primary-blue);
        }

        @media (max-width: 576px) {
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
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            color: #dc3545;
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

        // Enhanced form interactions
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
