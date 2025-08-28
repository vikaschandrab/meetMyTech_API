@extends('Users.Layouts.auth')

@section('title', __('Sign In | MeetMyTech'))

@section('description', 'Sign in to your MeetMyTech account to access your dashboard and manage your professional profile.')

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
                    <h1 class="h2 fw-bold text-dark">{{ __('auth.welcome_back') }}</h1>
                    <p class="lead text-muted">
                        {{ __('auth.sign_in_message') }}
                    </p>
                </div>

                {{-- Login Card --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        {{-- Flash Messages --}}
                        @include('Users.Components.flash-messages')

                        {{-- Login Form --}}
                        @include('Users.Components.login-form')

                    </div>
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

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
@endpush
