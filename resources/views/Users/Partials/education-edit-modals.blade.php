{{-- Edit Education Modals --}}
@if($hasEducation)
    @foreach ($education as $edu)
        <div class="modal fade" id="editEducationModal{{ $edu->id }}" tabindex="-1" aria-labelledby="editEducationLabel{{ $edu->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('education.update', $edu->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEducationLabel{{ $edu->id }}">
                                <i data-feather="edit-3" class="feather-sm me-2"></i>
                                Edit Education
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
                                        <label for="edit_degree{{ $edu->id }}" class="form-label">
                                            Degree <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('degree') is-invalid @enderror" 
                                               id="edit_degree{{ $edu->id }}" 
                                               name="degree" 
                                               value="{{ old('degree', $edu->degree) }}" 
                                               placeholder="e.g., Bachelor of Science"
                                               required>
                                        @error('degree')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Percentage/CGPA Field --}}
                                    <div class="mb-3">
                                        <label for="edit_precentage{{ $edu->id }}" class="form-label">
                                            Percentage / CGPA <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('precentage') is-invalid @enderror" 
                                               id="edit_precentage{{ $edu->id }}" 
                                               name="precentage" 
                                               value="{{ old('precentage', $edu->percentage_or_cgpa) }}" 
                                               placeholder="e.g., 85% or 8.5 CGPA"
                                               required>
                                        @error('precentage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- University Field --}}
                                    <div class="mb-3">
                                        <label for="edit_university{{ $edu->id }}" class="form-label">
                                            University/Institution <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('university') is-invalid @enderror" 
                                               id="edit_university{{ $edu->id }}" 
                                               name="university" 
                                               value="{{ old('university', $edu->university) }}" 
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
                                        <label for="edit_from_date{{ $edu->id }}" class="form-label">
                                            From Date <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control @error('from_date') is-invalid @enderror" 
                                               id="edit_from_date{{ $edu->id }}" 
                                               name="from_date" 
                                               value="{{ old('from_date', $edu->from_date) }}" 
                                               required>
                                        @error('from_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- To Date Field --}}
                                    <div class="mb-3">
                                        <label for="edit_to_date{{ $edu->id }}" class="form-label">
                                            To Date <small class="text-muted">(Leave empty if currently studying)</small>
                                        </label>
                                        <input type="date" 
                                               class="form-control @error('to_date') is-invalid @enderror" 
                                               id="edit_to_date{{ $edu->id }}" 
                                               name="to_date" 
                                               value="{{ old('to_date', $edu->to_date) }}">
                                        @error('to_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Currently Studying Checkbox --}}
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="edit_currently_studying{{ $edu->id }}" 
                                                   {{ !$edu->to_date ? 'checked' : '' }}
                                                   onchange="toggleEditToDate({{ $edu->id }})">
                                            <label class="form-check-label" for="edit_currently_studying{{ $edu->id }}">
                                                Currently studying here
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Description Field (Full Width) --}}
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="edit_description{{ $edu->id }}" class="form-label">
                                            Description <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="edit_description{{ $edu->id }}" 
                                                  name="description" 
                                                  rows="4" 
                                                  placeholder="Describe your studies, achievements, notable projects, etc."
                                                  required>{{ old('description', $edu->description) }}</textarea>
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
                                Update Education
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

<script>
function toggleEditToDate(eduId) {
    const checkbox = document.getElementById('edit_currently_studying' + eduId);
    const toDateInput = document.getElementById('edit_to_date' + eduId);
    
    if (checkbox.checked) {
        toDateInput.value = '';
        toDateInput.disabled = true;
        toDateInput.required = false;
    } else {
        toDateInput.disabled = false;
    }
}
</script>
