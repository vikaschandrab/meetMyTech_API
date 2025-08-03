{{-- Professional Skills Modal --}}
<div class="modal fade" id="editskills" tabindex="-1" aria-labelledby="editSkillsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('activities.professionalSkills') }}" method="POST">
                @csrf
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editSkillsLabel">Edit Professional Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        @php
                            $skillFields = [
                                'communication' => 'Communication',
                                'team_work' => 'Team Work',
                                'project_management' => 'Project Management',
                                'creativity' => 'Creativity',
                                'team_management' => 'Team Management',
                                'active_participation' => 'Active Participation',
                            ];
                        @endphp

                        @foreach($skillFields as $field => $label)
                            <div class="col-md-6 mb-3">
                                <label for="{{ $field }}" class="form-label">{{ $label }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" 
                                           class="form-control @error($field) is-invalid @enderror" 
                                           id="{{ $field }}" 
                                           name="{{ $field }}"
                                           value="{{ old($field, $skillsDefaults[$field] ?? 80) }}" 
                                           min="0" 
                                           max="100" 
                                           required>
                                    <span class="input-group-text">%</span>
                                    @error($field)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">Rate your {{ strtolower($label) }} skill from 0 to 100.</small>
                            </div>
                        @endforeach
                    </div>

                    <div class="alert alert-info mt-3">
                        <i data-feather="info" class="feather-sm me-2"></i>
                        <strong>Tip:</strong> Be honest about your skill levels. This helps provide an accurate representation of your professional capabilities.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="save" class="feather-sm me-1"></i>
                        Save Skills
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
