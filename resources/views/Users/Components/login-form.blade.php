{{-- Login Form Component --}}
<form action="{{ route('login.submit') }}" method="POST" class="needs-validation" novalidate>
    @csrf

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

    {{-- Remember Me Checkbox --}}
    <div class="mb-3">
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember"
                {{ old('remember') ? 'checked' : '' }}
            >
            <label class="form-check-label" for="remember">
                {{ __('auth.remember_me') }}
            </label>
        </div>
    </div>

    {{-- Forgot Password Link --}}
    <div class="mb-3">
        <a href="{{ route('forgot-password') }}" class="text-decoration-none text-muted">
            <i class="fas fa-key me-1"></i>{{ __('auth.forgot_password') }}
        </a>
    </div>

    {{-- Submit Button --}}
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-lg btn-primary">
            <i class="fas fa-sign-in-alt me-2"></i>
            {{ __('auth.sign_in') }}
        </button>
    </div>
</form>
