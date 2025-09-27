<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Mock Interview | MeetMyTech</title>
    <meta name="description" content="Prepare for your next tech interview! Book a mock interview with MeetMyTech and get expert guidance to boost your confidence and improve your technical skills.">
    <meta name="keywords" content="mock interview, tech interview preparation, interview practice, MeetMyTech, coding interview, career guidance">


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
                        <a class="nav-link" href="{{ route('home.mock-interview') }}">Mock Interview</a>
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
                        Book Your Mock  <span class="text-warning">Interview</span>
                    </h1>
                    <p class="lead mb-4">
                        Get ready to shine in your next real interview!
                        Our mock interview sessions are designed to help you practice, gain confidence,
                        and receive constructive feedback from industry professionals.
                        Choose your preferred date, time, and technology, and let’s prepare you for success.
                    </p>
                    <div class="row g-4 mt-4">
                        <div class="col-md-3 text-center">
                            <div class="feature-icon mb-2">
                                <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                            </div>
                            <h6>Real Interview Experience</h6>
                            <small>Practice with experts who simulate real interview scenarios</small>
                        </div>

                        <div class="col-md-3 text-center">
                            <div class="feature-icon mb-2">
                                <i class="fas fa-comments fa-2x text-success"></i>
                            </div>
                            <h6>Personalized Feedback</h6>
                            <small>Get actionable insights to improve your performance</small>
                        </div>

                        <div class="col-md-3 text-center">
                            <div class="feature-icon mb-2">
                                <i class="fas fa-clock fa-2x text-warning"></i>
                            </div>
                            <h6>Flexible Scheduling</h6>
                            <small>Book sessions on weekdays (7–11 PM) or weekends (11 AM–11 PM)</small>
                        </div>

                        <div class="col-md-3 text-center">
                            <div class="feature-icon mb-2">
                                <i class="fas fa-laptop-code fa-2x text-info"></i>
                            </div>
                            <h6>Wide Tech Coverage</h6>
                            <small>PHP, Laravel, WordPress, Symfony, Node.js, Angular, Vue.js & more</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="text-center mb-5">
                    <h2 class="fw-bold">Book Your Mock Interview</h2>
                    <p class="text-muted">
                        Prepare for success with our expert-led mock interviews.
                        Choose your preferred technology, time slot, and experience level —
                        and get real-time feedback to boost your confidence.
                    </p>
                </div>

                <form action="{{ route('mock-interview.submit') }}" method="POST" class="row g-4">
                    @csrf

                    <!-- Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">
                            <i class="fas fa-user me-2 text-primary"></i>Full Name *
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">
                            <i class="fas fa-envelope me-2 text-primary"></i>Email *
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="col-md-6">
                        <label for="date" class="form-label fw-semibold">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Select Date *
                        </label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                               id="date" name="date" value="{{ old('date') }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Time -->
                    <div class="col-md-6">
                        <label for="time" class="form-label fw-semibold">
                            <i class="fas fa-clock me-2 text-primary"></i>Select Time *
                        </label>
                        <input type="time" class="form-control @error('time') is-invalid @enderror"
                               id="time" name="time" value="{{ old('time') }}" required>
                        <small class="text-muted">
                            Weekdays: 7 PM – 11 PM | Weekends: 11 AM – 11 PM
                        </small>
                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Experience Level -->
                    <div class="col-md-12">
                        <label for="experience" class="form-label fw-semibold">
                            <i class="fas fa-briefcase me-2 text-primary"></i>Experience Level *
                        </label>
                        <select class="form-select @error('experience') is-invalid @enderror"
                                id="experience" name="experience" required>
                            <option value="">-- Select --</option>
                            <option value="Fresher" {{ old('experience') == 'Fresher' ? 'selected' : '' }}>Fresher (0 years)</option>
                            <option value="0-1" {{ old('experience') == '0-1' ? 'selected' : '' }}>0 - 1 Year</option>
                            <option value="1-2" {{ old('experience') == '1-2' ? 'selected' : '' }}>1 - 2 Years</option>
                            <option value="2-3" {{ old('experience') == '2-3' ? 'selected' : '' }}>2 - 3 Years</option>
                        </select>
                        @error('experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Technology -->
                    <div class="col-md-12">
                        <label for="technology" class="form-label fw-semibold">
                            <i class="fas fa-code me-2 text-primary"></i>Select Technology *
                        </label>
                        <select class="form-select @error('technology') is-invalid @enderror"
                                id="technology" name="technology" required>
                            <option value="">-- Select --</option>
                            <option value="PHP" {{ old('technology') == 'PHP' ? 'selected' : '' }}>PHP</option>
                            <option value="Laravel" {{ old('technology') == 'Laravel' ? 'selected' : '' }}>Laravel</option>
                            <option value="WordPress" {{ old('technology') == 'WordPress' ? 'selected' : '' }}>WordPress</option>
                            <option value="Symfony" {{ old('technology') == 'Symfony' ? 'selected' : '' }}>Symfony</option>
                            <option value="CodeIgniter" {{ old('technology') == 'CodeIgniter' ? 'selected' : '' }}>CodeIgniter</option>
                            <option value="MySQL" {{ old('technology') == 'MySQL' ? 'selected' : '' }}>MySQL</option>
                            <option value="Node.js" {{ old('technology') == 'Node.js' ? 'selected' : '' }}>Node.js</option>
                            <option value="Angular" {{ old('technology') == 'Angular' ? 'selected' : '' }}>Angular</option>
                            <option value="Vue.js" {{ old('technology') == 'Vue.js' ? 'selected' : '' }}>Vue.js</option>
                        </select>
                        @error('technology')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <label for="notes" class="form-label fw-semibold">
                            <i class="fas fa-comment-dots me-2 text-primary"></i>Additional Notes
                        </label>
                        <textarea class="form-control @error('notes') is-invalid @enderror"
                                  id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
                        @error('notes')
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
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-5 py-2">
                            <i class="fas fa-paper-plane me-2"></i>Book Interview
                        </button>
                    </div>
                </form>

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
                    <h5>Quick Feedback</h5>
                    <p class="text-muted">Receive timely feedback on your interview performance within 24 hours.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h5>Mock Interviews</h5>
                    <p class="text-muted">Practice one-on-one with experts to boost your confidence and improve your answers.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Confidential Guidance</h5>
                    <p class="text-muted">All your interview data and feedback are kept secure and private.</p>
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
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("date");
        const timeInput = document.getElementById("time");

        dateInput.addEventListener("change", function () {
            const selectedDate = new Date(this.value);
            const day = selectedDate.getDay(); // 0=Sunday, 6=Saturday

            if (day === 0 || day === 6) {
                // Weekend: 11 AM – 11 PM
                timeInput.min = "11:00";
                timeInput.max = "23:00";
            } else {
                // Weekday: 7 PM – 11 PM
                timeInput.min = "19:00";
                timeInput.max = "23:00";
            }
        });
     });
    </script>
</body>
</html>
