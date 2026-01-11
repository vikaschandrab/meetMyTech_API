@extends('Users.Layouts.app')

@section('title', 'About | ' . Auth::user()->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/interview-questions.css') }}">
@endpush

@section('content')
<div class="container-fluid p-0">

    {{-- Header --}}
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 d-inline align-middle">
                My Interview Questions
                <span class="badge bg-warning text-dark ms-2">Coming Soon</span>
            </h1>
            <p class="text-muted mb-0">
                Manage your personal interview question bank
            </p>
        </div>

        {{-- <a href="{{ route('interviewQuestions.create') }}" class="btn btn-primary">
            <i data-feather="plus" class="feather-sm me-1"></i>
            Add New Question
        </a> --}}
        <button class="btn btn-primary" disabled>
            <i data-feather="plus" class="feather-sm me-1"></i>
            Add New Question
        </button>
    </div>

    {{-- Question List --}}
    @if($hasQuestions)
        <div class="row">
            @foreach($questions as $question)
                <div class="col-12 col-md-6 mb-3">
                    <div class="card h-100 position-relative">
                        <div class="card-body">

                            {{-- Question Title --}}
                            <h6 class="mb-2">
                                {{ $question->title }}
                            </h6>

                            {{-- Meta --}}
                            <div class="text-muted small mb-2">
                                <i data-feather="calendar" class="feather-sm me-1"></i>
                                Added {{ $question->created_at->diffForHumans() }}

                                @if($question->level)
                                    · <span class="badge bg-secondary">{{ ucfirst($question->level) }}</span>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('interview-questions.show', $question->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="View">
                                    <i data-feather="eye"></i>
                                </a>

                                <a href="{{ route('interview-questions.edit', $question->id) }}"
                                   class="btn btn-sm btn-outline-warning"
                                   title="Edit">
                                    <i data-feather="edit"></i>
                                </a>

                                <form action="{{ route('interview-questions.destroy', $question->id) }}"
                                      method="POST"
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $questions->links() }}
        </div>
    @else
        {{-- Empty State --}}
        <div class="card">
            <div class="card-body text-center py-5 text-muted">
                <i data-feather="help-circle" style="width:48px;height:48px;"></i>
                <h5 class="mt-3">No Interview Questions Yet</h5>
                <p>Create your first interview question to start building your library.</p>

                {{-- <a href="{{ route('interviewQuestions.create') }}" class="btn btn-primary">
                    <i data-feather="plus" class="feather-sm me-1"></i>
                    Add New Question
                </a> --}}
                <button class="btn btn-primary" disabled>
                    <i data-feather="plus" class="feather-sm me-1"></i>
                    Add New Question
                </button>
            </div>
        </div>
    @endif

</div>
@endsection
