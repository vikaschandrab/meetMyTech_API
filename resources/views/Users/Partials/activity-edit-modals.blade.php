{{-- Edit Activity Modals --}}
@foreach ($activities as $activity)
    <div class="modal fade" id="edit-{{ $activity->id }}" tabindex="-1" aria-labelledby="editActivityLabel-{{ $activity->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('activities.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $activity->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editActivityLabel-{{ $activity->id }}">Edit Activity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="work_name_{{ $activity->id }}" class="form-label">Work Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('workName') is-invalid @enderror" 
                                   id="work_name_{{ $activity->id }}" 
                                   name="workName"
                                   value="{{ old('workName', $activity->action) }}"
                                   placeholder="Enter the name of your work or project"
                                   required>
                            @error('workName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="work_description_{{ $activity->id }}" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="work_description_{{ $activity->id }}" 
                                      name="description"
                                      rows="6" 
                                      placeholder="Describe what you do, your responsibilities, achievements, etc."
                                      required>{{ old('description', $activity->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimum 10 characters, maximum 2000 characters.</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="save" class="feather-sm me-1"></i>
                            Update Activity
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
