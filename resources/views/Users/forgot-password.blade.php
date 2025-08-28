@extends('Users.Layouts.auth')

@section('title', __('Forgot Password | MeetMyTech'))

@section('description', 'Reset your MeetMyTech account password. Enter your email address to receive a new password.')

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
                    <h1 class="h2 fw-bold text-dark">{{ __('Forgot Password?') }}</h1>
                    <p class="lead text-muted">
                        {{ __("Enter your email address and we'll send you a new password.") }}
                    </p>
                </div>

                {{-- Forgot Password Card --}}
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

                        {{-- Forgot Password Form --}}
                        <form method="POST" action="{{ route('forgot-password.submit') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-2 text-primary"></i>{{ __('Email Address') }}
                                </label>
                                <input type="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
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

                            {{-- Honeypot (Anti-spam) --}}
                            @honeypot

                            {{-- Google reCAPTCHA --}}
                            <div class="mb-3 text-center">
                                <div class="d-flex justify-content-center">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                                @error('g-recaptcha-response')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>{{ __('Send New Password') }}
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
                            <strong>Security Notice:</strong> For your security, we'll send a new auto-generated password to your email.
                            Please change it after logging in.
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
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .form-control-lg {
        border-radius: 0.5rem;
        border: 1px solid #e0e6ed;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .alert {
        border-radius: 0.5rem;
    }

    .text-primary {
        color: #667eea !important;
    }
</style>
@endpush

@push('scripts')
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

    // Auto-hide alerts after 8 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                if (alert && alert.classList.contains('show')) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 8000);
        });
    });
</script>
@endpush
