{{-- Add Activity Modal --}}
<div class="modal fade" id="addWhatIdo" tabindex="-1" aria-labelledby="addActivityLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('activities.store') }}" method="POST">
                @csrf
                
                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityLabel">Add New Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="workName" class="form-label">Work Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('workName') is-invalid @enderror" 
                               id="workName" 
                               name="workName" 
                               value="{{ old('workName') }}"
                               placeholder="Enter the name of your work or project"
                               required>
                        @error('workName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="6" 
                                  placeholder="Describe what you do, your responsibilities, achievements, etc."
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimum 10 characters, maximum 2000 characters.</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="plus" class="feather-sm me-1"></i>
                        Add Activity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
