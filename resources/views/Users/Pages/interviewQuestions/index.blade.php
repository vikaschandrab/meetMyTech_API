@extends('Users.Layouts.app')

@section('title', 'Interview Questions | ' . Auth::user()->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/interview-questions.css') }}">
@endpush

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1 class="h3 d-inline align-middle">My Interview Questions</h1>
            <p class="text-muted mb-0">Manage your personal interview question bank</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('interviewQuestions.import') }}" class="btn btn-outline-primary">
                <i data-feather="upload" class="feather-sm me-1"></i>
                Import
            </a>
            <a href="{{ route('interviewQuestions.create') }}" class="btn btn-primary">
                <i data-feather="plus" class="feather-sm me-1"></i>
                Add New Question
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($hasQuestions)
        <div class="row">
            @foreach($questions as $question)
                <div class="col-12 col-md-6 mb-3">
                    <div class="card h-100 position-relative">
                        <div class="card-body">
                            <h6 class="mb-2">{{ Str::limit(strip_tags($question->question), 140) }}</h6>

                            <div class="text-muted small mb-2">
                                <i data-feather="calendar" class="feather-sm me-1"></i>
                                Added {{ $question->created_at->diffForHumans() }}

                                @if($question->level)
                                    · <span class="badge bg-secondary">{{ ucfirst($question->level) }}</span>
                                @endif

                                @if($question->category)
                                    · <span class="badge bg-light text-dark">{{ $question->category }}</span>
                                @endif
                            </div>

                            @if($question->answer)
                                <p class="text-muted mb-0">{{ Str::limit(strip_tags($question->answer), 120) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $questions->links() }}
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5 text-muted">
                <i data-feather="help-circle" style="width:48px;height:48px;"></i>
                <h5 class="mt-3">No Interview Questions Yet</h5>
                <p>Create your first interview question to start building your library.</p>

                <a href="{{ route('interviewQuestions.create') }}" class="btn btn-primary">
                    <i data-feather="plus" class="feather-sm me-1"></i>
                    Add New Question
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
