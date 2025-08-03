@extends('Users.Layouts.app')

@section('title', 'Education | ' . Auth::user()->name)

@push('styles')
<style>
    .education-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .education-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-left-color: #007bff;
    }
    
    .education-meta {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .education-degree {
        color: #495057;
        font-weight: 600;
    }
    
    .education-university {
        color: #007bff;
        font-weight: 500;
    }
    
    .education-period {
        background: #f8f9fa;
        border-radius: 0.25rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.85rem;
        border: 1px solid #e9ecef;
    }
    
    .education-score {
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
    
    .current-study {
        background: #28a745;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    {{-- Header Section --}}
    <div class="mb-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 d-inline align-middle">Education</h1>
                <p class="text-muted mb-0">Manage your educational background and qualifications</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                <i data-feather="plus" class="feather-sm me-1"></i>
                Add Education
            </button>
        </div>

        {{-- Statistics Cards --}}
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="book-open" class="feather-lg text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $educationCount }}</h3>
                                <p class="text-muted mb-0">Education Records</p>
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
                                <i data-feather="award" class="feather-lg text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $education ? $education->where('to_date', '!=', null)->count() : 0 }}</h3>
                                <p class="text-muted mb-0">Completed</p>
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
                                <h3 class="mb-0">{{ $education ? $education->where('to_date', null)->count() : 0 }}</h3>
                                <p class="text-muted mb-0">Ongoing</p>
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
                                    if ($education) {
                                        foreach ($education as $edu) {
                                            $fromDate = \Carbon\Carbon::parse($edu->from_date);
                                            $toDate = $edu->to_date ? \Carbon\Carbon::parse($edu->to_date) : \Carbon\Carbon::now();
                                            $totalYears += $fromDate->diffInYears($toDate);
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

        {{-- Education Timeline --}}
        @if($hasEducation)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i data-feather="list" class="feather-sm me-2"></i>
                        Education Timeline
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($education->sortByDesc('from_date') as $edu)
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="card education-card h-100">
                                    <div class="card-body">
                                        {{-- Header with Actions --}}
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="timeline-indicator {{ !$edu->to_date ? 'current-study' : '' }}"></div>
                                                <div>
                                                    <h6 class="card-title education-degree mb-1">{{ $edu->degree }}</h6>
                                                    <p class="education-university mb-0">{{ $edu->university }}</p>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    <i data-feather="more-horizontal"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editEducationModal{{ $edu->id }}">
                                                            <i data-feather="edit" class="feather-sm me-2"></i>Edit
                                                        </button>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('education.delete', $edu->id) }}" method="POST" class="d-inline delete-form">
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

                                        {{-- Education Meta Information --}}
                                        <div class="row g-2 mb-3">
                                            <div class="col-12">
                                                <div class="d-flex flex-wrap gap-2">
                                                    <span class="education-period">
                                                        <i data-feather="calendar" class="feather-sm me-1"></i>
                                                        {{ \Carbon\Carbon::parse($edu->from_date)->format('M Y') }} - 
                                                        {{ $edu->to_date ? \Carbon\Carbon::parse($edu->to_date)->format('M Y') : 'Present' }}
                                                    </span>
                                                    <span class="education-score">
                                                        <i data-feather="award" class="feather-sm me-1"></i>
                                                        {{ $edu->percentage_or_cgpa }}
                                                    </span>
                                                    @if(!$edu->to_date)
                                                        <span class="badge bg-success">Currently Studying</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Description --}}
                                        <div class="education-description">
                                            <p class="text-muted mb-0" style="text-align: justify;">
                                                {{ Str::limit($edu->description, 150) }}
                                                @if(strlen($edu->description) > 150)
                                                    <button class="btn btn-sm btn-link p-0 ms-1" type="button" 
                                                            data-bs-toggle="collapse" data-bs-target="#desc-{{ $edu->id }}">
                                                        Read more
                                                    </button>
                                                    <div class="collapse mt-2" id="desc-{{ $edu->id }}">
                                                        <div class="text-muted">{{ $edu->description }}</div>
                                                    </div>
                                                @endif
                                            </p>
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
                    <i data-feather="book-open"></i>
                    <h5>No Education Records</h5>
                    <p class="text-muted">Start building your educational profile by adding your first education record.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                        <i data-feather="plus" class="feather-sm me-1"></i>
                        Add Your First Education
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Include Modals --}}
@include('Users.Partials.education-add-modal')
@include('Users.Partials.education-edit-modals')
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
                text: "You won't be able to revert this education record!",
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
