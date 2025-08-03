{{-- Add Work Experience Modal --}}
<div class="modal fade" id="addWorkExperienceModal" tabindex="-1" aria-labelledby="addWorkExperienceLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('work-experience.add') }}" method="POST" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addWorkExperienceLabel">
                        <i data-feather="briefcase" class="feather-sm me-2"></i>
                        Add Work Experience
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
                            {{-- Organization Field --}}
                            <div class="mb-3">
                                <label for="organization" class="form-label">
                                    Organization <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('organization') is-invalid @enderror" 
                                       id="organization" 
                                       name="organization" 
                                       value="{{ old('organization') }}" 
                                       placeholder="e.g., Tech Solutions Inc."
                                       required>
                                @error('organization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Position Field --}}
                            <div class="mb-3">
                                <label for="position" class="form-label">
                                    Position <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('position') is-invalid @enderror" 
                                       id="position" 
                                       name="position" 
                                       value="{{ old('position') }}" 
                                       placeholder="e.g., Senior Software Developer"
                                       required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- From Date Field --}}
                            <div class="mb-3">
                                <label for="from_date" class="form-label">
                                    From Year <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control @error('from_date') is-invalid @enderror" 
                                       id="from_date" 
                                       name="from_date" 
                                       value="{{ old('from_date') }}" 
                                       min="1900" 
                                       max="{{ date('Y') + 10 }}"
                                       placeholder="{{ date('Y') }}"
                                       required>
                                @error('from_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- To Date Field --}}
                            <div class="mb-3">
                                <label for="to_date" class="form-label">
                                    To Year <small class="text-muted">(Leave empty if currently working)</small>
                                </label>
                                <input type="number" 
                                       class="form-control @error('to_date') is-invalid @enderror" 
                                       id="to_date" 
                                       name="to_date" 
                                       value="{{ old('to_date') }}" 
                                       min="1900" 
                                       max="{{ date('Y') + 10 }}"
                                       placeholder="{{ date('Y') }}">
                                @error('to_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Currently Working Checkbox --}}
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="currently_working" onchange="toggleToYear()">
                                    <label class="form-check-label" for="currently_working">
                                        Currently working here
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Roles and Responsibilities Field (Full Width) --}}
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="roles_and_responsibilities" class="form-label">
                                    Roles and Responsibilities <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('roles_and_responsibilities') is-invalid @enderror" 
                                          id="roles_and_responsibilities" 
                                          name="roles_and_responsibilities" 
                                          rows="5" 
                                          placeholder="Describe your key responsibilities, achievements, and contributions in this role..."
                                          required>{{ old('roles_and_responsibilities') }}</textarea>
                                @error('roles_and_responsibilities')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Minimum 10 characters, maximum 5000 characters</div>
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
                        Save Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleToYear() {
    const checkbox = document.getElementById('currently_working');
    const toYearInput = document.getElementById('to_date');
    
    if (checkbox.checked) {
        toYearInput.value = '';
        toYearInput.disabled = true;
        toYearInput.required = false;
    } else {
        toYearInput.disabled = false;
    }
}
</script>
