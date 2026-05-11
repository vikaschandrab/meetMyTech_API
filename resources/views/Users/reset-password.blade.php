@extends('Users.Layouts.auth')

@section('title', __('Reset Password | MeetMyTech'))

@section('description', 'Reset your MeetMyTech account password with a new secure password.')

@section('content')
<main class="d-flex w-100 min-vh-100">
    <div class="container d-flex flex-column">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">

                {{-- Header Section --}}
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <img src="{{ asset('meetmytech_logo.jpg') }}" alt="MeetMyTech" style="height: 64px; width: auto; margin-bottom: 16px;">
                    </div>
                    <h1 class="h2 fw-bold text-dark">{{ __('Reset Your Password') }}</h1>
                    <p class="lead text-muted">
                        {{ __('Enter your new password below to complete the reset process.') }}
                    </p>
                </div>

                {{-- Reset Password Card --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        {{-- Flash Messages --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>{{ __('Whoops! Something went wrong.') }}</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Reset Password Form --}}
                        <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
                            @csrf

                            {{-- Hidden Token --}}
                            <input type="hidden" name="token" value="{{ request()->route('token') ?? $token }}">

                            {{-- Email Field --}}
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-2 text-primary"></i>{{ __('Email Address') }}
                                </label>
                                <input type="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', request('email')) }}"
                                       placeholder="Enter your registered email address"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            {{-- New Password Field --}}
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-primary"></i>{{ __('New Password') }}
                                </label>
                                <input type="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Enter your new password"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <small class="text-muted">
                                        Password must contain at least 8 characters with 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special symbol. No spaces allowed.
                                    </small>
                                </div>
                            </div>

                            {{-- Confirm Password Field --}}
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-primary"></i>{{ __('Confirm New Password') }}
                                </label>
                                <input type="password"
                                       class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Confirm your new password"
                                       required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            {{-- Honeypot (Anti-spam) --}}
                            @honeypot

                            {{-- Google reCAPTCHA - Only show if not in local environment or if captcha is explicitly enabled --}}
                            @if(!app()->environment('local') || !config('captcha.disable_in_local', false))
                                <div class="mb-3 text-center">
                                    <div class="d-flex justify-content-center">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    @error('g-recaptcha-response')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                {{-- Local development notice --}}
                                <div class="mb-3">
                                    <div class="alert alert-info small text-center">
                                        <i class="fas fa-info-circle me-1"></i>
                                        CAPTCHA disabled for local development
                                    </div>
                                </div>
                            @endif

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-key me-2"></i>{{ __('Reset Password') }}
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="text-muted mb-0">
                                    {{ __('Remember your password?') }}
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                        {{ __('Back to Sign In') }}
                                    </a>
                                </p>
                            </div>
                        </form>

                    </div>
                </div>

                {{-- Security Notice --}}
                <div class="text-center mt-4">
                    <div class="alert alert-info border-0" style="background: linear-gradient(135deg, #e3f2fd, #f0f9ff);">
                        <i class="fas fa-shield-alt text-primary me-2"></i>
                        <small class="text-muted">
                            <strong>Security Notice:</strong> Choose a strong password that you haven't used before. Your password will be securely encrypted.
                        </small>
                    </div>
                </div>

                {{-- Footer Links --}}
                <div class="text-center mt-3">
                    <p class="text-muted small">
                        {{ __('Need help?') }}
                        <a href="mailto:admin@meetmytech.com" class="text-decoration-none">{{ __('Contact Support') }}</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<!-- Google reCAPTCHA -->
@if(!app()->environment('local') || !config('captcha.disable_in_local', false))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

<style>
    .min-vh-100 {
        min-height: 100vh;
    }

    .card {
        border-radius: 0.75rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .alert {
        border-radius: 0.5rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script>
    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSymbols = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
        const hasSpaces = /\s/.test(password);
        const isLongEnough = password.length >= 8;

        // Visual feedback could be added here
    });

    // Form validation
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush
