@extends('Users.Layouts.app')

@section('title', 'What I Do | ' . Auth::user()->name)

@push('styles')
<style>
    .activity-card {
        transition: all 0.3s ease;
    }
    
    .activity-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .skill-progress {
        height: 1.5rem;
        border-radius: 0.5rem;
    }
    
    .skill-percentage {
        font-weight: 600;
        color: #495057;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    {{-- Activities Section --}}
    <div class="mb-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1 class="h3 d-inline align-middle">What I Do</h1>
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addWhatIdo">
                <i data-feather="plus"></i> Add Activity
            </button>
        </div>

        @if($hasActivities)
            <div class="row">
                @foreach ($activities as $activity)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card activity-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $activity->action }}</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i data-feather="more-horizontal"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-{{ $activity->id }}">
                                                    <i data-feather="edit" class="feather-sm me-2"></i>Edit
                                                </button>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('activities.delete', $activity->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('Are you sure you want to delete this activity?')">
                                                        <i data-feather="trash-2" class="feather-sm me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text text-muted">{{ Str::limit($activity->description, 150) }}</p>
                                @if(strlen($activity->description) > 150)
                                    <button class="btn btn-sm btn-link p-0" type="button" data-bs-toggle="collapse" data-bs-target="#desc-{{ $activity->id }}">
                                        Read more
                                    </button>
                                    <div class="collapse mt-2" id="desc-{{ $activity->id }}">
                                        <div class="text-muted">{{ $activity->description }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card">
                <div class="card-body empty-state">
                    <i data-feather="briefcase"></i>
                    <h5>No Activities Yet</h5>
                    <p class="text-muted">Start by adding your first activity to showcase what you do.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWhatIdo">
                        <i data-feather="plus" class="feather-sm me-1"></i>
                        Add Your First Activity
                    </button>
                </div>
            </div>
        @endif
    </div>

    {{-- Professional Skills Section --}}
    <div class="mb-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1 class="h3 d-inline align-middle">Professional Skills</h1>
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editskills">
                <i data-feather="edit"></i> Edit Skills
            </button>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9">
                <div class="card">
                    @if($professionalSkills)
                        <div class="card-body">
                            @php
                                $skillsData = [
                                    'communication' => ['label' => 'Communication', 'value' => $professionalSkills->communication ?? 80],
                                    'team_work' => ['label' => 'Team Work', 'value' => $professionalSkills->team_work ?? 85],
                                    'project_management' => ['label' => 'Project Management', 'value' => $professionalSkills->project_management ?? 75],
                                    'creativity' => ['label' => 'Creativity', 'value' => $professionalSkills->creativity ?? 90],
                                    'team_management' => ['label' => 'Team Management', 'value' => $professionalSkills->team_management ?? 70],
                                    'active_participation' => ['label' => 'Active Participation', 'value' => $professionalSkills->active_participation ?? 95],
                                ];
                            @endphp

                            @foreach($skillsData as $skill => $data)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="skill-label">{{ $data['label'] }}</span>
                                        <span class="skill-percentage">{{ $data['value'] }}%</span>
                                    </div>
                                    <div class="progress skill-progress">
                                        <div class="progress-bar" 
                                             role="progressbar" 
                                             style="width: {{ $data['value'] }}%" 
                                             aria-valuenow="{{ $data['value'] }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="card-body empty-state">
                            <i data-feather="bar-chart"></i>
                            <h5>No Skills Data</h5>
                            <p class="text-muted">Add your professional skills to showcase your capabilities.</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editskills">
                                <i data-feather="plus" class="feather-sm me-1"></i>
                                Add Skills
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="col-12 col-lg-4 col-xxl-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i data-feather="info" class="feather-sm me-2"></i>Statistics
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-primary">{{ $activitiesCount }}</h3>
                                    <p class="text-muted mb-0">Total Activities</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Include Modals --}}
@include('Users.Partials.activity-add-modal')
@include('Users.Partials.activity-edit-modals')
@include('Users.Partials.professional-skills-modal')
@endsection

@push('scripts')
@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        title: 'Validation Error!',
        text: "{{ $errors->first() }}",
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endpush
