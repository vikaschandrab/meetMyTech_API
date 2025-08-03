{{-- Edit About Modal --}}
<div class="modal fade" id="editAboutMe" tabindex="-1" aria-labelledby="editAboutMeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('abouteMe.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editAboutMeLabel">Edit About Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Tell us about yourself, your skills, and experience..."
                                  required>{{ old('description', $details->about ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimum 10 characters, maximum 5000 characters.</small>
                    </div>

                    {{-- Technologies --}}
                    <div class="mb-3">
                        <label for="technologies" class="form-label">Technologies <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('technologies') is-invalid @enderror" 
                               name="technologies" 
                               id="technologies" 
                               value="{{ old('technologies', $details->technologies ?? '') }}" 
                               placeholder="HTML, CSS, JavaScript, Laravel, Vue.js, MySQL..."
                               required>
                        @error('technologies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">List your technologies separated by commas. Maximum 1000 characters.</small>
                    </div>

                    {{-- Resume Upload --}}
                    <div class="mb-3">
                        <label for="resume" class="form-label">Resume (PDF)</label>
                        <input type="file" 
                               class="form-control @error('resume') is-invalid @enderror" 
                               name="resume" 
                               id="resume"
                               accept=".pdf">
                        @error('resume')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        @if($hasResume)
                            <div class="mt-2">
                                <small class="text-muted">
                                    Current resume: 
                                    <a href="{{ $resumeUrl }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                        <i data-feather="external-link" class="feather-sm"></i> View Current Resume
                                    </a>
                                </small>
                            </div>
                        @endif
                        
                        <small class="text-muted d-block mt-1">
                            Upload a PDF file. Maximum file size: 10MB.
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="save" class="feather-sm me-1"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
