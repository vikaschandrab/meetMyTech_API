@extends('Users.Layouts.app')

@section('title', 'Import Interview Questions | ' . Auth::user()->name)

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3">Import Interview Questions</h1>
        <a href="{{ route('interviewQuestions.index') }}" class="btn btn-secondary btn-sm">? Back</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('interviewQuestions.import.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Upload File (PDF, DOC, DOCX, TXT)</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                    @error('file')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Max size: 10MB</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Default Level</label>
                        <select name="level" class="form-select @error('level') is-invalid @enderror">
                            <option value="junior">Junior</option>
                            <option value="mid">Mid</option>
                            <option value="senior">Senior</option>
                        </select>
                        @error('level')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Default Category</label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" placeholder="e.g. Laravel, React, System Design">
                        @error('category')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Formatting Guide</label>
                    <div class="alert alert-light border">
                        <div class="mb-2"><strong>Best results:</strong></div>
                        <div>Q: What is MVC?</div>
                        <div>A: Model-View-Controller is a pattern that ...</div>
                        <div class="mt-2">Separate questions with a blank line.</div>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">Import Questions</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
