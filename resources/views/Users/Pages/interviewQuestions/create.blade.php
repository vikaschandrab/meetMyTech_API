@extends('Users.Layouts.app')

@section('title', 'Add Interview Question | ' . Auth::user()->name)

@push('styles')
<style>
    .ck-editor__editable {
        min-height: 180px;
    }
    .ck-content pre {
        background: #0f172a;
        color: #e5e7eb;
        padding: 12px;
        border-radius: 6px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3">Add Interview Question</h1>
        <a href="{{ route('interviewQuestions.index') }}" class="btn btn-secondary btn-sm">? Back</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="{{ route('interviewQuestions.store') }}">
                @csrf

                {{-- Question (Rich Text) --}}
                <div class="mb-4">
                    <label class="form-label">
                        Question <span class="text-danger">*</span>
                    </label>
                    <textarea
                        name="question"
                        id="questionEditor"
                        class="form-control @error('question') is-invalid @enderror"
                    >{{ old('question') }}</textarea>

                    @error('question')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Answer (Rich Text) --}}
                <div class="mb-4">
                    <label class="form-label">
                        Answer
                    </label>
                    <textarea
                        name="answer"
                        id="answerEditor"
                        class="form-control @error('answer') is-invalid @enderror"
                    >{{ old('answer') }}</textarea>

                    @error('answer')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Level <span class="text-danger">*</span></label>
                        <select name="level" class="form-select @error('level') is-invalid @enderror">
                            <option value="junior" {{ old('level') === 'junior' ? 'selected' : '' }}>Junior</option>
                            <option value="mid" {{ old('level') === 'mid' ? 'selected' : '' }}>Mid</option>
                            <option value="senior" {{ old('level') === 'senior' ? 'selected' : '' }}>Senior</option>
                        </select>
                        @error('level')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Category</label>
                        <input
                            type="text"
                            name="category"
                            class="form-control @error('category') is-invalid @enderror"
                            value="{{ old('category') }}"
                            placeholder="e.g. Laravel, React, System Design"
                        />
                        @error('category')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">Save Question</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    function initEditor(selector) {
        const element = document.querySelector(selector);
        if (!element) {
            return;
        }

        ClassicEditor.create(element, {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', 'link',
                'bulletedList', 'numberedList', '|',
                'codeBlock', 'blockQuote', 'insertTable', '|',
                'undo', 'redo'
            ],
            codeBlock: {
                languages: [
                    { language: 'plaintext', label: 'Plain text' },
                    { language: 'php', label: 'PHP' },
                    { language: 'javascript', label: 'JavaScript' },
                    { language: 'html', label: 'HTML' },
                    { language: 'css', label: 'CSS' },
                    { language: 'sql', label: 'SQL' }
                ]
            },
        }).catch(console.error);
    }

    initEditor('#questionEditor');
    initEditor('#answerEditor');
</script>
@endpush
