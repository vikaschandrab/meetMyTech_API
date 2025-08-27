<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | MeetMyTech</title>
    <meta name="description" content="Reset your MeetMyTech account password. Enter your email address to receive a new password.">

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
            --info-blue: #3b82f6;
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

        .forgot-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
        }

        .forgot-card {
            background: var(--bg-white);
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            padding: 3rem;
            border: 1px solid var(--border-light);
            position: relative;
            overflow: hidden;
        }

        .forgot-card::before {
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

        .forgot-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .forgot-subtitle {
            color: var(--text-gray);
            font-size: 1rem;
            margin-bottom: 0;
            line-height: 1.5;
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

        .back-link {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
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

        .alert-info {
            background: linear-gradient(135deg, #e3f2fd, #f0f9ff);
            color: var(--info-blue);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .security-notice {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            padding: 1rem;
            margin-top: 2rem;
        }

        .back-home {
            text-align: center;
            margin-top: 1.5rem;
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
            .forgot-container {
                padding: 1rem;
            }

            .forgot-card {
                padding: 2rem 1.5rem;
            }

            .forgot-title {
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

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .forgot-card {
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
        <div class="forgot-container">
            <div class="forgot-card">
                <!-- Logo Section -->
                <div class="logo-section">
                    <img src="{{ asset('meetmytech_logo.jpg') }}" alt="MeetMyTech">
                    <h1 class="forgot-title">{{ __('Forgot Password?') }}</h1>
                    <p class="forgot-subtitle">{{ __("Enter your email address and we'll send you a new password.") }}</p>
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
                            <i class="fas fa-paper-plane me-2"></i>{{ __('Send New Password') }}
                        </button>
                    </div>

                    <!-- Back to Login -->
                    <div class="text-center">
                        <p class="text-muted mb-0">
                            {{ __('Remember your password?') }}
                            <a href="{{ route('login') }}" class="back-link">
                                {{ __('Back to Sign In') }}
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Security Notice -->
                <div class="security-notice">
                    <i class="fas fa-shield-alt text-primary me-2"></i>
                    <small class="text-muted">
                        <strong>Security Notice:</strong> For your security, we'll send a new auto-generated password to your email.
                        Please change it after logging in.
                    </small>
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
