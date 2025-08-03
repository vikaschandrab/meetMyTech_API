@extends('Users.Layouts.app')

@section('title', 'About | ' . Auth::user()->name)

@push('styles')
<style>
    .technology-tag {
        display: inline-block;
        background-color: #e9ecef;
        color: #495057;
        padding: 0.25rem 0.5rem;
        margin: 0.125rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
    }
    
    .about-description {
        text-align: justify;
        line-height: 1.6;
    }
    
    .resume-container {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">About Me</h1>
        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editAboutMe">
            <i data-feather="edit"></i> Edit
        </button>
    </div>

    <div class="card mb-3">
        {{-- Description Section --}}
        @if($details && $details->about)
            <div class="card-body">
                <h5 class="h6 card-title">
                    <i data-feather="user" class="feather-sm me-2"></i>Description
                </h5>
                <div class="text-muted about-description">
                    {{ $details->about }}
                </div>
            </div>
        @else
            <div class="card-body">
                <h5 class="h6 card-title">
                    <i data-feather="user" class="feather-sm me-2"></i>Description
                </h5>
                <div class="text-muted">
                    <em>No description added yet. Click "Edit" to add your description.</em>
                </div>
            </div>
        @endif

        <hr class="my-0" />

        {{-- Technologies Section --}}
        <div class="card-body">
            <h5 class="h6 card-title">
                <i data-feather="code" class="feather-sm me-2"></i>My Technologies
            </h5>
            @if($details && $details->technologies)
                <div class="mb-2">
                    @foreach($technologies as $tech)
                        <span class="technology-tag">{{ $tech }}</span>
                    @endforeach
                </div>
                <small class="text-muted">{{ $details->technologies }}</small>
            @else
                <div class="text-muted">
                    <em>No technologies listed yet. Click "Edit" to add your technologies.</em>
                </div>
            @endif
        </div>

        {{-- Resume Section --}}
        @if($hasResume)
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">
                    <i data-feather="file-text" class="feather-sm me-2"></i>My Resume
                </h5>
                <div class="resume-container">
                    <iframe src="{{ $resumeUrl }}" 
                            width="100%" 
                            height="600px" 
                            style="border: none;"
                            title="Resume PDF">
                        <p>Your browser does not support PDFs. 
                           <a href="{{ $resumeUrl }}" target="_blank" rel="noopener noreferrer">Download the PDF</a>.
                        </p>
                    </iframe>
                </div>
                <div class="mt-2">
                    <a href="{{ $resumeUrl }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="btn btn-sm btn-outline-secondary">
                        <i data-feather="download" class="feather-sm me-1"></i>
                        Download Resume
                    </a>
                </div>
            </div>
        @else
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">
                    <i data-feather="file-text" class="feather-sm me-2"></i>My Resume
                </h5>
                <div class="text-muted">
                    <em>No resume uploaded yet. Click "Edit" to upload your resume.</em>
                </div>
            </div>
        @endif
    </div>
</div>

@include('Users.Partials.about-edit-modal')
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
