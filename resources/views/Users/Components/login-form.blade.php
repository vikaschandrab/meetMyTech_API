{{-- Login Form Component --}}
<form action="{{ route('login.submit') }}" method="POST" class="needs-validation" novalidate>
    @csrf

    {{-- Debug info for local development --}}
    @if(app()->environment('local'))
        <div class="alert alert-info small mb-3">
            <strong>Debug Info (Local Only):</strong><br>
            CSRF Token: {{ csrf_token() }}<br>
            Session ID: {{ session()->getId() }}<br>
            Form Action: {{ route('login.submit') }}
        </div>
    @endif

    {{-- Email Field --}}
    <div class="mb-3">
        <label for="email" class="form-label">
            {{ __('auth.email_address') }}
            <span class="text-danger">*</span>
        </label>
        <input
            id="email"
            class="form-control form-control-lg @error('email') is-invalid @enderror"
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

    {{-- Password Field --}}
    <div class="mb-3">
        <label for="password" class="form-label">
            {{ __('auth.password_label') }}
            <span class="text-danger">*</span>
        </label>
        <input
            id="password"
            class="form-control form-control-lg @error('password') is-invalid @enderror"
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

    {{-- Forgot Password Link --}}
    <div class="mb-3">
        <a href="{{ route('forgot-password') }}" class="text-decoration-none text-muted">
            <i class="fas fa-key me-1"></i>{{ __('auth.forgot_password') }}
        </a>
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

    {{-- Submit Button --}}
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-lg btn-primary">
            <i class="fas fa-sign-in-alt me-2"></i>
            {{ __('auth.sign_in') }}
        </button>
    </div>
</form>
