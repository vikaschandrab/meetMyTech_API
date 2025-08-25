@extends('admin.layout')

@section('title', 'Create New User')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Create New User</h1>
                    <p class="text-muted mb-0">Add a new user to the MeetMyTech platform</p>
                </div>
                <a href="{{ route('admin.users') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Users
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-plus me-2"></i>User Information
                    </h5>
                </div>
                <div class="card-body">

                    {{-- Auto-generation Info --}}
                    <div class="alert alert-info border-0 mb-4" style="background: linear-gradient(135deg, #e3f2fd, #f0f9ff);">
                        <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Auto-Generated Features</h6>
                        <ul class="mb-0 mt-2">
                            <li><strong>Slug:</strong> Automatically generated from the user's name (e.g., "john-doe")</li>
                            <li><strong>Password:</strong> Secure 12-character password auto-generated and sent via email</li>
                            <li><strong>User Type:</strong> Automatically set to "user" (non-admin)</li>
                            <li><strong>Status:</strong> Automatically activated</li>
                        </ul>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Please correct the following errors:</h6>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.store-user') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2 text-primary"></i>Full Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Enter user's full name"
                                           required>
                                    <div class="form-text">
                                        <i class="fas fa-lightbulb me-1"></i>This will be used to generate a unique profile slug
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope me-2 text-primary"></i>Email Address <span class="text-danger">*</span>
                                    </label>
                                    <input type="email"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="Enter user's email address"
                                           required>
                                    <div class="form-text">
                                        <i class="fas fa-paper-plane me-1"></i>Welcome email with login credentials will be sent here
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Security Information --}}
                        <div class="alert alert-warning border-0 mb-4">
                            <h6 class="alert-heading"><i class="fas fa-shield-alt me-2"></i>Security Information</h6>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <small><strong>Auto-Generated Password:</strong></small>
                                    <ul class="small mb-0 mt-1">
                                        <li>12 characters long</li>
                                        <li>Mix of uppercase, lowercase, numbers & symbols</li>
                                        <li>Encrypted and stored securely</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <small><strong>Email Delivery:</strong></small>
                                    <ul class="small mb-0 mt-1">
                                        <li>Welcome email with credentials</li>
                                        <li>Instructions to change password</li>
                                        <li>Getting started guide</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-3 pt-3">
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                <i class="fas fa-user-plus me-2"></i>Create User & Send Email
                            </button>
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Quick Actions Sidebar --}}
        <div class="col-xl-4 col-lg-2">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-users me-2"></i>View All Users
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </div>

                    <hr class="my-3">

                    <h6 class="text-muted mb-2">
                        <i class="fas fa-question-circle me-2"></i>Need Help?
                    </h6>
                    <small class="text-muted">
                        New users will receive a welcome email with their login credentials and getting started instructions.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control-lg {
        border-radius: 0.5rem;
        border: 1px solid #e0e6ed;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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

    .alert {
        border-radius: 0.75rem;
    }

    .card {
        border-radius: 0.75rem;
    }

    .text-primary {
        color: #667eea !important;
    }

    .form-text {
        color: #6c757d;
        font-size: 0.875rem;
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

    // Real-time slug preview
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
                        .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
                        .replace(/\s+/g, '-')        // Replace spaces with hyphens
                        .replace(/-+/g, '-')         // Replace multiple hyphens with single hyphen
                        .trim('-');                  // Remove leading/trailing hyphens

        const helpText = this.nextElementSibling;
        if (slug) {
            helpText.innerHTML = '<i class="fas fa-lightbulb me-1"></i>Profile slug will be: <strong>' + slug + '</strong>';
        } else {
            helpText.innerHTML = '<i class="fas fa-lightbulb me-1"></i>This will be used to generate a unique profile slug';
        }
    });
</script>
@endpush
