@extends('Users.Layouts.app')

@section('title', 'Profile | ' . Auth::user()->name)

@push('styles')
<link href="{{ asset('css/pages/profile.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Profile</h1>
        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
            <i data-feather="edit"></i> Edit
        </button>
    </div>

    <div class="card mb-3">
        <div class="card-body text-center">
            @if($user->profilePic)
                <img src="{{ asset('storage/' . $user->profilePic) }}"
                     alt="{{ Auth::user()->name }}"
                     class="img-fluid rounded-circle mb-2 profile-image" />
            @else
                <img src="{{ asset('dashboard_css/img/avatars/avatar.jpg') }}"
                     alt="{{ Auth::user()->name }}"
                     class="img-fluid rounded-circle mb-2 profile-image" />
            @endif
            <h5 class="card-title mb-0">{{ Auth::user()->name }}</h5>
            <div class="text-muted mb-2">Lead Developer</div>
        </div>

        <hr class="my-0" />

        <div class="card-body">
            <h5 class="h6 card-title">Contact Information</h5>
            <ul class="list-unstyled mb-0">
                @if($details && $details->address)
                    <li class="mb-1">
                        <span data-feather="home" class="feather-sm me-1"></span>
                        Lives in <span class="text-muted">{{ $details->address }}</span>
                    </li>
                @endif

                @if(Auth::user()->contactNum)
                    <li class="mb-1">
                        <span data-feather="phone" class="feather-sm me-1"></span>
                        Phone <span class="text-muted">{{ Auth::user()->contactNum }}</span>
                    </li>
                @endif

                <li class="mb-1">
                    <span data-feather="mail" class="feather-sm me-1"></span>
                    Email <span class="text-muted">{{ Auth::user()->email }}</span>
                </li>
            </ul>
        </div>

        @if($details)
            @php
                $socialLinks = [
                    'github_profile' => ['icon' => 'github', 'name' => 'GitHub'],
                    'twitter_profile' => ['icon' => 'twitter', 'name' => 'Twitter'],
                    'facebook_profile' => ['icon' => 'facebook', 'name' => 'Facebook'],
                    'instagram_profile' => ['icon' => 'instagram', 'name' => 'Instagram'],
                    'linkedin_profile' => ['icon' => 'linkedin', 'name' => 'LinkedIn'],
                ];

                $hasSocialLinks = false;
                foreach($socialLinks as $key => $config) {
                    if(!empty($details->$key)) {
                        $hasSocialLinks = true;
                        break;
                    }
                }
            @endphp

            @if($hasSocialLinks)
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Social Media</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach($socialLinks as $key => $config)
                            @if(!empty($details->$key))
                                <li class="mb-1">
                                    <span data-feather="{{ $config['icon'] }}" class="feather-sm me-1"></span>
                                    <a href="{{ $details->$key }}" target="_blank" rel="noopener noreferrer">
                                        {{ $config['name'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
    </div>
</div>

@include('Users.Partials.profile-edit-modal')
@endsection

@push('scripts')
<script src="{{ asset('js/pages/profile.js') }}"></script>

@if(session('success'))
<script>
    ProfileManager.messages.showSuccess("{{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
    ProfileManager.messages.showError("{{ session('error') }}");
</script>
@endif

@if($errors->any())
<script>
    ProfileManager.messages.showValidationError("{{ $errors->first() }}");
</script>
@endif
@endpush
