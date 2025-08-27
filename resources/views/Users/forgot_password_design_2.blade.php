<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Recovery | MeetMyTech CyberSpace</title>
    <meta name="description" content="Recover your MeetMyTech account access. Enter your credentials to restore system access.">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('meetmytech_favicon.jpg') }}" type="image/jpeg">
    <link rel="shortcut icon" href="{{ asset('meetmytech_favicon.jpg') }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #0a0a0b;
            --bg-secondary: #111116;
            --bg-tertiary: #1a1a24;
            --gold-primary: #ffd700;
            --gold-secondary: #ffed4e;
            --gold-dark: #b8860b;
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --text-gold: #ffd700;
            --border-primary: #27272a;
            --border-gold: rgba(255, 215, 0, 0.3);
            --shadow-gold: 0 0 30px rgba(255, 215, 0, 0.3);
            --shadow-primary: 0 8px 32px rgba(0, 0, 0, 0.6);
            --danger-primary: #ef4444;
            --success-primary: #10b981;
            --info-primary: #3b82f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(ellipse at center, var(--bg-secondary) 0%, var(--bg-primary) 100%);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Particle System */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--gold-primary);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            opacity: 0.6;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) translateX(0px);
                opacity: 0.6;
            }
            50% { 
                transform: translateY(-20px) translateX(10px);
                opacity: 1;
            }
        }

        /* Cyber Grid Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255, 215, 0, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 215, 0, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            opacity: 0.3;
            animation: gridPulse 4s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes gridPulse {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.4; }
        }

        /* Mouse Trail Effect */
        .mouse-trail {
            position: fixed;
            width: 20px;
            height: 20px;
            border: 2px solid var(--gold-primary);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transition: all 0.1s ease;
            opacity: 0;
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
            background: linear-gradient(135deg, var(--bg-tertiary), var(--bg-secondary));
            border-radius: 20px;
            box-shadow: var(--shadow-primary), inset 0 1px 0 rgba(255, 215, 0, 0.1);
            padding: 3rem;
            border: 1px solid var(--border-gold);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .forgot-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
            animation: scanLine 3s linear infinite;
        }

        @keyframes scanLine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-section img {
            height: 64px;
            width: auto;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 10px var(--gold-primary));
        }

        .forgot-title {
            font-family: 'Orbitron', monospace;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-gold);
            margin-bottom: 0.5rem;
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            animation: titleGlow 2s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from { text-shadow: 0 0 20px rgba(255, 215, 0, 0.5); }
            to { text-shadow: 0 0 30px rgba(255, 215, 0, 0.8); }
        }

        .forgot-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 0;
            line-height: 1.6;
            font-weight: 300;
        }

        .cyber-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
            margin: 2rem 0;
            animation: pulse 2s ease-in-out infinite;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-gold);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Space Grotesk', sans-serif;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .form-label i {
            color: var(--gold-primary);
            filter: drop-shadow(0 0 5px var(--gold-primary));
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-gold);
            border-radius: 8px;
            padding: 16px 20px;
            font-size: 1rem;
            font-weight: 400;
            color: var(--text-primary);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            position: relative;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--gold-primary);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.3), inset 0 0 20px rgba(255, 215, 0, 0.1);
            outline: none;
            color: var(--text-primary);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            font-style: italic;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold-primary));
            border: 1px solid var(--gold-primary);
            border-radius: 8px;
            padding: 16px 2rem;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            color: var(--bg-primary);
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
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            box-shadow: var(--shadow-gold);
            transform: translateY(-2px);
            color: var(--bg-primary);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .back-link {
            color: var(--gold-primary);
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
            height: 1px;
            background: var(--gold-primary);
            transition: width 0.3s ease;
        }

        .back-link:hover {
            color: var(--gold-secondary);
            text-shadow: 0 0 10px var(--gold-primary);
        }

        .back-link:hover::after {
            width: 100%;
        }

        .alert {
            border-radius: 8px;
            border: none;
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
            background: currentColor;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-primary);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-primary);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info-primary);
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .security-notice {
            background: rgba(255, 215, 0, 0.05);
            border: 1px solid var(--border-gold);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 2rem;
            position: relative;
        }

        .security-notice::before {
            content: '⚡';
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1.2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .security-notice .content {
            margin-left: 2rem;
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
            color: var(--gold-primary);
            text-shadow: 0 0 10px var(--gold-primary);
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
            border-color: var(--danger-primary) !important;
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.3) !important;
        }

        .invalid-feedback {
            color: var(--danger-primary);
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
            animation: fadeInScale 0.8s ease forwards;
            opacity: 0;
            transform: scale(0.9) rotateX(10deg);
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1) rotateX(0deg);
            }
        }

        /* Holographic effect on hover */
        .form-control:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--gold-secondary);
        }

        /* Glitch effect for title */
        .forgot-title:hover {
            animation: glitch 0.3s ease-in-out;
        }

        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(-2px, -2px); }
            60% { transform: translate(2px, 2px); }
            80% { transform: translate(2px, -2px); }
            100% { transform: translate(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>
<body>
    <!-- Particle System -->
    <div class="particles" id="particles"></div>
    
    <!-- Mouse Trail -->
    <div class="mouse-trail" id="mouseTrail"></div>

    <div class="container">
        <div class="forgot-container">
            <div class="forgot-card">
                <!-- Logo Section -->
                <div class="logo-section">
                    <img src="{{ asset('meetmytech_logo.jpg') }}" alt="MeetMyTech CyberSpace">
                    <h1 class="forgot-title">{{ __('ACCESS RECOVERY') }}</h1>
                    <p class="forgot-subtitle">{{ __("Initialize password recovery protocol. Enter your system credentials to restore access.") }}</p>
                </div>

                <div class="cyber-divider"></div>

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
                            {{ __('System Email ID') }}
                        </label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter registered system email address..."
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
                            <i class="fas fa-rocket me-2"></i>{{ __('INITIATE RECOVERY') }}
                        </button>
                    </div>

                    <!-- Back to Login -->
                    <div class="text-center">
                        <p class="text-muted mb-0" style="color: var(--text-secondary) !important;">
                            {{ __('Access credentials restored?') }}
                            <a href="{{ route('login') }}" class="back-link">
                                {{ __('Return to Access Portal') }}
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Security Notice -->
                <div class="security-notice">
                    <div class="content">
                        <small style="color: var(--text-secondary);">
                            <strong style="color: var(--text-gold);">SECURITY PROTOCOL:</strong> 
                            A new auto-generated access key will be transmitted to your registered email.
                            Immediate credential update recommended upon system re-entry.
                        </small>
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="back-home">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i>
                        <span>Return to Command Center</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Particle System
        function createParticles() {
            const particleContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (3 + Math.random() * 6) + 's';
                
                particleContainer.appendChild(particle);
            }
        }

        // Mouse Trail Effect
        function initMouseTrail() {
            const trail = document.getElementById('mouseTrail');
            let mouseX = 0, mouseY = 0;
            let trailX = 0, trailY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                trail.style.opacity = '1';
            });

            function updateTrail() {
                trailX += (mouseX - trailX) * 0.1;
                trailY += (mouseY - trailY) * 0.1;
                
                trail.style.left = trailX - 10 + 'px';
                trail.style.top = trailY - 10 + 'px';
                
                requestAnimationFrame(updateTrail);
            }
            updateTrail();

            document.addEventListener('mouseleave', () => {
                trail.style.opacity = '0';
            });
        }

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

        // Auto-hide alerts with cyber effect
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            initMouseTrail();

            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(100px) scale(0.8)';
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.parentNode.removeChild(alert);
                        }
                    }, 300);
                }, 5000);
            });
        });

        // Enhanced form interactions with cyber effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.style.boxShadow = '0 0 30px rgba(255, 215, 0, 0.4), inset 0 0 30px rgba(255, 215, 0, 0.1)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
                this.style.boxShadow = '0 0 20px rgba(255, 215, 0, 0.3), inset 0 0 20px rgba(255, 215, 0, 0.1)';
            });

            // Typing effect
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.style.color = '#ffd700';
                    this.style.textShadow = '0 0 10px rgba(255, 215, 0, 0.5)';
                } else {
                    this.style.color = '#ffffff';
                    this.style.textShadow = 'none';
                }
            });
        });

        // Button hover effects
        const button = document.querySelector('.btn-primary');
        button.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 0 40px rgba(255, 215, 0, 0.6)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 0 30px rgba(255, 215, 0, 0.3)';
        });
    </script>
</body>
</html>
