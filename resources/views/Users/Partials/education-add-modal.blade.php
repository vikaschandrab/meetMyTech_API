{{-- Add Education Modal --}}
<div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('education.add') }}" method="POST" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEducationLabel">
                        <i data-feather="book-open" class="feather-sm me-2"></i>
                        Add Education
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Validation Error Display --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i data-feather="alert-circle" class="feather-sm me-2"></i>
                                </div>
                                <div>
                                    <h6 class="alert-heading mb-1">Please fix the following errors:</h6>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Degree Field --}}
                            <div class="mb-3">
                                <label for="degree" class="form-label">
                                    Degree <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('degree') is-invalid @enderror" 
                                       id="degree" 
                                       name="degree" 
                                       value="{{ old('degree') }}" 
                                       placeholder="e.g., Bachelor of Science"
                                       required>
                                @error('degree')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Percentage/CGPA Field --}}
                            <div class="mb-3">
                                <label for="precentage" class="form-label">
                                    Percentage / CGPA <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('precentage') is-invalid @enderror" 
                                       id="precentage" 
                                       name="precentage" 
                                       value="{{ old('precentage') }}" 
                                       placeholder="e.g., 85% or 8.5 CGPA"
                                       required>
                                @error('precentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- University Field --}}
                            <div class="mb-3">
                                <label for="university" class="form-label">
                                    University/Institution <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('university') is-invalid @enderror" 
                                       id="university" 
                                       name="university" 
                                       value="{{ old('university') }}" 
                                       placeholder="e.g., University of Technology"
                                       required>
                                @error('university')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- From Date Field --}}
                            <div class="mb-3">
                                <label for="from_date" class="form-label">
                                    From Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('from_date') is-invalid @enderror" 
                                       id="from_date" 
                                       name="from_date" 
                                       value="{{ old('from_date') }}" 
                                       required>
                                @error('from_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- To Date Field --}}
                            <div class="mb-3">
                                <label for="to_date" class="form-label">
                                    To Date <small class="text-muted">(Leave empty if currently studying)</small>
                                </label>
                                <input type="date" 
                                       class="form-control @error('to_date') is-invalid @enderror" 
                                       id="to_date" 
                                       name="to_date" 
                                       value="{{ old('to_date') }}">
                                @error('to_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Currently Studying Checkbox --}}
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="currently_studying" onchange="toggleToDate()">
                                    <label class="form-check-label" for="currently_studying">
                                        Currently studying here
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Description Field (Full Width) --}}
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4" 
                                          placeholder="Describe your studies, achievements, notable projects, etc."
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Maximum 1000 characters</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i data-feather="x" class="feather-sm me-1"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="save" class="feather-sm me-1"></i>
                        Save Education
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleToDate() {
    const checkbox = document.getElementById('currently_studying');
    const toDateInput = document.getElementById('to_date');
    
    if (checkbox.checked) {
        toDateInput.value = '';
        toDateInput.disabled = true;
        toDateInput.required = false;
    } else {
        toDateInput.disabled = false;
    }
}
</script>
