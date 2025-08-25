@extends('admin.layout')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('page-actions')
    <div class="btn-group">
        <a href="{{ route('admin.users') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Back to Users
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-user me-2"></i>Basic Information</h6>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    @if($user->userDetail && $user->userDetail->profile_image)
                        <img src="{{ asset('storage/' . $user->userDetail->profile_image) }}"
                             alt="{{ $user->name }}"
                             class="rounded-circle img-fluid"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center text-white"
                             style="width: 120px; height: 120px; font-size: 2rem;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <h5 class="mb-1">{{ $user->name }}</h5>
                <p class="text-muted mb-2">{{ $user->email }}</p>
                <span class="badge bg-{{ $user->user_type === 'admin' ? 'danger' : 'primary' }} mb-3">
                    {{ ucfirst($user->user_type) }}
                </span>
                <br>
                <span class="badge bg-{{ ($user->status ?? 'active') === 'active' ? 'success' : 'warning' }}">
                    {{ ucfirst($user->status ?? 'active') }}
                </span>

                <hr>

                <div class="row text-center">
                    <div class="col-6">
                        <h6 class="mb-0">{{ $user->activities->count() }}</h6>
                        <small class="text-muted">Activities</small>
                    </div>
                    <div class="col-6">
                        <h6 class="mb-0">{{ $user->created_at->diffForHumans() }}</h6>
                        <small class="text-muted">Joined</small>
                    </div>
                </div>
            </div>
        </div>

        @if($user->userDetail)
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-info-circle me-2"></i>Contact Details</h6>
            </div>
            <div class="card-body">
                @if($user->contactNum)
                    <div class="mb-2">
                        <strong>Phone:</strong> {{ $user->contactNum }}
                    </div>
                @endif
                @if($user->userDetail->address)
                    <div class="mb-2">
                        <strong>Address:</strong> {{ $user->userDetail->address }}
                    </div>
                @endif
                @if($user->userDetail->linkedin_profile)
                    <div class="mb-2">
                        <strong>LinkedIn:</strong>
                        <a href="{{ $user->userDetail->linkedin_profile }}" target="_blank" class="text-decoration-none">
                            {{ $user->userDetail->linkedin_profile }}
                        </a>
                    </div>
                @endif
                @if($user->userDetail->github_profile)
                    <div class="mb-2">
                        <strong>GitHub:</strong>
                        <a href="{{ $user->userDetail->github_profile }}" target="_blank" class="text-decoration-none">
                            {{ $user->userDetail->github_profile }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-8">
        @if($user->userDetail && $user->userDetail->about)
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-user-circle me-2"></i>About</h6>
            </div>
            <div class="card-body">
                <p>{{ $user->userDetail->about }}</p>
            </div>
        </div>
        @endif

        @if($user->workExperiences && $user->workExperiences->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-briefcase me-2"></i>Work Experience</h6>
            </div>
            <div class="card-body">
                @foreach($user->workExperiences as $experience)
                    <div class="border-left border-primary pl-3 mb-3" style="border-left: 3px solid #007bff !important; padding-left: 1rem;">
                        <h6 class="mb-1">{{ $experience->job_title }}</h6>
                        <p class="text-muted mb-1">{{ $experience->company_name }}</p>
                        <small class="text-muted">
                            {{ $experience->start_date ? \Carbon\Carbon::parse($experience->start_date)->format('M Y') : 'N/A' }} -
                            {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                        </small>
                        @if($experience->description)
                            <p class="mt-2">{{ $experience->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($user->educationDetails && $user->educationDetails->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-graduation-cap me-2"></i>Education</h6>
            </div>
            <div class="card-body">
                @foreach($user->educationDetails as $education)
                    <div class="border-left border-success pl-3 mb-3" style="border-left: 3px solid #28a745 !important; padding-left: 1rem;">
                        <h6 class="mb-1">{{ $education->degree }}</h6>
                        <p class="text-muted mb-1">{{ $education->institution }}</p>
                        <small class="text-muted">
                            {{ $education->start_date ? \Carbon\Carbon::parse($education->start_date)->format('Y') : 'N/A' }} -
                            {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('Y') : 'Present' }}
                        </small>
                        @if($education->grade)
                            <p class="mt-1"><strong>Grade:</strong> {{ $education->grade }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($user->userProfessionalSkills && $user->userProfessionalSkills->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-cogs me-2"></i>Professional Skills</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($user->userProfessionalSkills as $skill)
                        <div class="col-md-6 mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $skill->skill_name }}</span>
                                <span class="badge bg-primary">{{ $skill->proficiency_level }}%</span>
                            </div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $skill->proficiency_level }}%"
                                     aria-valuenow="{{ $skill->proficiency_level }}"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-history me-2"></i>Recent Activities</h6>
            </div>
            <div class="card-body">
                @if($user->activities && $user->activities->count() > 0)
                    <div class="timeline">
                        @foreach($user->activities->take(10) as $activity)
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 30px; height: 30px;">
                                        <i class="fas fa-dot-circle text-white" style="font-size: 8px;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ $activity->activity_name }}</h6>
                                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                    @if($activity->description)
                                        <p class="mb-0 mt-1">{{ $activity->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No recent activities found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Add any JavaScript for user details interactions
</script>
@endsection
