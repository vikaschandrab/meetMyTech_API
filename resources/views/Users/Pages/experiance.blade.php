@extends('Users.Layouts.app')

@section('title', 'Work Experience | ' . Auth::user()->name)

@push('styles')
<style>
    .experience-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .experience-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-left-color: #007bff;
    }
    
    .experience-meta {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .experience-position {
        color: #495057;
        font-weight: 600;
    }
    
    .experience-organization {
        color: #007bff;
        font-weight: 500;
    }
    
    .experience-period {
        background: #f8f9fa;
        border-radius: 0.25rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.85rem;
        border: 1px solid #e9ecef;
    }
    
    .experience-duration {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        border-radius: 1rem;
        padding: 0.25rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 600;
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
    
    .timeline-indicator {
        width: 12px;
        height: 12px;
        background: #007bff;
        border-radius: 50%;
        margin-right: 0.5rem;
        flex-shrink: 0;
        margin-top: 0.25rem;
    }
    
    .current-position {
        background: #28a745;
    }
    
    .responsibilities-preview {
        max-height: 4.5rem;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    {{-- Header Section --}}
    <div class="mb-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 d-inline align-middle">Work Experience</h1>
                <p class="text-muted mb-0">Manage your professional work history and achievements</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkExperienceModal">
                <i data-feather="plus" class="feather-sm me-1"></i>
                Add Experience
            </button>
        </div>

        {{-- Statistics Cards --}}
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="briefcase" class="feather-lg text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $experienceCount }}</h3>
                                <p class="text-muted mb-0">Total Positions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="building" class="feather-lg text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $workExperiences ? $workExperiences->unique('organization')->count() : 0 }}</h3>
                                <p class="text-muted mb-0">Organizations</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="clock" class="feather-lg text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $workExperiences ? $workExperiences->where('to_date', null)->count() : 0 }}</h3>
                                <p class="text-muted mb-0">Current Positions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="calendar" class="feather-lg text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                @php
                                    $totalYears = 0;
                                    if ($workExperiences) {
                                        foreach ($workExperiences as $exp) {
                                            $fromYear = $exp->from_date;
                                            $toYear = $exp->to_date ?? date('Y');
                                            $totalYears += ($toYear - $fromYear);
                                        }
                                    }
                                @endphp
                                <h3 class="mb-0">{{ $totalYears }}</h3>
                                <p class="text-muted mb-0">Total Years</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Experience Timeline --}}
        @if($hasExperiences)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i data-feather="list" class="feather-sm me-2"></i>
                        Professional Timeline
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($workExperiences->sortByDesc('from_date') as $experience)
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="card experience-card h-100">
                                    <div class="card-body">
                                        {{-- Header with Actions --}}
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="timeline-indicator {{ !$experience->to_date ? 'current-position' : '' }}"></div>
                                                <div>
                                                    <h6 class="card-title experience-position mb-1">{{ $experience->position ?? 'N/A' }}</h6>
                                                    <p class="experience-organization mb-0">{{ $experience->organization ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    <i data-feather="more-horizontal"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editWorkExperienceModal{{ $experience->id }}">
                                                            <i data-feather="edit" class="feather-sm me-2"></i>Edit
                                                        </button>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('work-experience.delete', $experience->id) }}" method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i data-feather="trash-2" class="feather-sm me-2"></i>Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        {{-- Experience Meta Information --}}
                                        <div class="row g-2 mb-3">
                                            <div class="col-12">
                                                <div class="d-flex flex-wrap gap-2">
                                                    <span class="experience-period">
                                                        <i data-feather="calendar" class="feather-sm me-1"></i>
                                                        {{ $experience->from_date }} - {{ $experience->to_date ?? 'Present' }}
                                                    </span>
                                                    @php
                                                        $duration = ($experience->to_date ?? date('Y')) - $experience->from_date;
                                                        $durationText = $duration > 1 ? $duration . ' years' : $duration . ' year';
                                                    @endphp
                                                    <span class="experience-duration">
                                                        <i data-feather="clock" class="feather-sm me-1"></i>
                                                        {{ $durationText }}
                                                    </span>
                                                    @if(!$experience->to_date)
                                                        <span class="badge bg-success">Current Position</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Roles and Responsibilities --}}
                                        <div class="experience-description">
                                            <h6 class="mb-2">
                                                <i data-feather="list" class="feather-sm me-1"></i>
                                                Key Responsibilities
                                            </h6>
                                            <div class="responsibilities-preview">
                                                <p class="text-muted mb-0" style="text-align: justify;">
                                                    {{ Str::limit($experience->roles_and_responsibilities ?? '', 200) }}
                                                </p>
                                            </div>
                                            @if(strlen($experience->roles_and_responsibilities ?? '') > 200)
                                                <button class="btn btn-sm btn-link p-0 mt-1" type="button" 
                                                        data-bs-toggle="collapse" data-bs-target="#responsibilities-{{ $experience->id }}">
                                                    Read more
                                                </button>
                                                <div class="collapse mt-2" id="responsibilities-{{ $experience->id }}">
                                                    <div class="text-muted">{{ $experience->roles_and_responsibilities }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="card">
                <div class="card-body empty-state">
                    <i data-feather="briefcase"></i>
                    <h5>No Work Experience</h5>
                    <p class="text-muted">Start building your professional profile by adding your first work experience.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkExperienceModal">
                        <i data-feather="plus" class="feather-sm me-1"></i>
                        Add Your First Experience
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Include Modals --}}
@include('Users.Partials.experience-add-modal')
@include('Users.Partials.experience-edit-modals')
@endsection

@push('scripts')
{{-- Success/Error Messages --}}
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

{{-- Delete Confirmation --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete forms with SweetAlert
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this work experience!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
