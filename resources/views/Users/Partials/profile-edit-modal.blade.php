{{-- Edit Profile Modal --}}
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    {{-- Profile Picture Section --}}
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('storage/' . $user->profilePic) }}" 
                                 id="profilePreview" 
                                 class="img-fluid rounded-circle mb-2" 
                                 width="128" 
                                 height="128" 
                                 alt="Profile Preview" />
                            
                            <div class="mb-3">
                                <label for="profile_pic" class="form-label">Profile Picture</label>
                                <input type="file" 
                                       name="profile_pic" 
                                       id="profile_pic"
                                       class="form-control @error('profile_pic') is-invalid @enderror" 
                                       accept="image/*" 
                                       onchange="previewImage(event)">
                                @error('profile_pic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Basic Information --}}
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', Auth::user()->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', Auth::user()->email) }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="contactNum" class="form-label">Phone / WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('contactNum') is-invalid @enderror" 
                                       id="contactNum" 
                                       name="contactNum" 
                                       value="{{ old('contactNum', Auth::user()->contactNum) }}"
                                       required>
                                @error('contactNum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" 
                                          name="address" 
                                          rows="3"
                                          required>{{ old('address', $details->address ?? '') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    
                    {{-- Social Links Section --}}
                    <h6 class="mb-3">Social Links <small class="text-muted">(Optional)</small></h6>
                    
                    <div class="row">
                        @php
                            $socialFields = [
                                'github' => ['label' => 'GitHub', 'placeholder' => 'https://github.com/username'],
                                'twitter' => ['label' => 'Twitter', 'placeholder' => 'https://twitter.com/username'],
                                'facebook' => ['label' => 'Facebook', 'placeholder' => 'https://facebook.com/username'],
                                'instagram' => ['label' => 'Instagram', 'placeholder' => 'https://instagram.com/username'],
                                'linkedin' => ['label' => 'LinkedIn', 'placeholder' => 'https://linkedin.com/in/username'],
                            ];
                        @endphp
                        
                        @foreach($socialFields as $field => $config)
                            <div class="col-md-6 mb-3">
                                <label for="{{ $field }}" class="form-label">{{ $config['label'] }}</label>
                                <input type="url" 
                                       class="form-control @error($field) is-invalid @enderror" 
                                       id="{{ $field }}" 
                                       name="{{ $field }}" 
                                       value="{{ old($field, $details->{$field . '_profile'} ?? '') }}"
                                       placeholder="{{ $config['placeholder'] }}">
                                @error($field)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
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
