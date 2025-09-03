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
                                       onchange="initImageCropper(event)">
                                @error('profile_pic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Crop Type Selection -->
                            <div class="mb-3" id="cropTypeSection" style="display: none;">
                                <label class="form-label">Crop Style</label>
                                <div class="btn-group w-100" role="group" aria-label="Crop style">
                                    <input type="radio" class="btn-check" name="cropType" id="cropSquare" value="square" checked>
                                    <label class="btn btn-outline-primary" for="cropSquare">
                                        <i class="fas fa-square me-1"></i> Square
                                    </label>

                                    <input type="radio" class="btn-check" name="cropType" id="cropCircle" value="circle">
                                    <label class="btn btn-outline-primary" for="cropCircle">
                                        <i class="fas fa-circle me-1"></i> Circle
                                    </label>
                                </div>
                            </div>

                            <!-- Crop Action Buttons -->
                            <div class="mb-3" id="cropActions" style="display: none;">
                                <div class="btn-group w-100" role="group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="applyCrop()">
                                        <i class="fas fa-check me-1"></i> Apply Crop
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="cancelCrop()">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden input to store cropped image data -->
                            <input type="hidden" name="cropped_image" id="croppedImageData">
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

{{-- Image Cropper Modal --}}
<div class="modal fade" id="imageCropperModal" tabindex="-1" aria-labelledby="imageCropperLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageCropperLabel">Crop Your Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cancelCrop()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="crop-container" style="max-height: 400px; overflow: hidden;">
                            <img id="cropperImage" style="max-width: 100%;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h6>Preview</h6>
                            <div id="cropPreview" class="mx-auto mb-3" style="width: 120px; height: 120px; border: 2px solid #ddd; border-radius: 8px; overflow: hidden; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                <span class="text-muted">Preview will appear here</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Crop Style</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="modalCropType" id="modalCropSquare" value="square" checked onchange="changeCropStyle()">
                                    <label class="btn btn-outline-primary btn-sm" for="modalCropSquare">
                                        <i class="fas fa-square me-1"></i> Square
                                    </label>

                                    <input type="radio" class="btn-check" name="modalCropType" id="modalCropCircle" value="circle" onchange="changeCropStyle()">
                                    <label class="btn btn-outline-primary btn-sm" for="modalCropCircle">
                                        <i class="fas fa-circle me-1"></i> Circle
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="resetCrop()">
                                    <i class="fas fa-undo me-1"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="cancelCrop()">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="applyCrop()">
                    <i class="fas fa-check me-1"></i> Apply Crop
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Include Cropper.js CSS and JS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<style>
    .crop-container {
        position: relative;
        background: #f8f9fa;
    }

    .cropper-view-box,
    .cropper-face {
        border-radius: 0;
    }

    .crop-circle .cropper-view-box,
    .crop-circle .cropper-face {
        border-radius: 50%;
    }

    .crop-preview {
        overflow: hidden;
        background: #fff;
        border: 2px solid #ddd;
    }

    .crop-preview.circle {
        border-radius: 50%;
    }

    .crop-preview.square {
        border-radius: 8px;
    }
</style>

<script>
    let cropper = null;
    let currentFile = null;
    let cropType = 'square';

    function initImageCropper(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            event.target.value = '';
            return;
        }

        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            alert('Image size should be less than 5MB.');
            event.target.value = '';
            return;
        }

        currentFile = file;
        const reader = new FileReader();

        reader.onload = function(e) {
            const cropperImage = document.getElementById('cropperImage');
            cropperImage.src = e.target.result;

            // Show the cropper modal
            const modal = new bootstrap.Modal(document.getElementById('imageCropperModal'));
            modal.show();

            // Initialize cropper after modal is shown
            document.getElementById('imageCropperModal').addEventListener('shown.bs.modal', function() {
                initCropper();
            }, { once: true });
        };

        reader.readAsDataURL(file);
    }

    function initCropper() {
        if (cropper) {
            cropper.destroy();
        }

        const cropperImage = document.getElementById('cropperImage');
        const aspectRatio = cropType === 'circle' ? 1 : 1; // Both square and circle use 1:1 ratio

        cropper = new Cropper(cropperImage, {
            aspectRatio: aspectRatio,
            viewMode: 2,
            autoCropArea: 0.8,
            responsive: true,
            restore: false,
            guides: true,
            center: true,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: false,
            ready: function() {
                updateCropperStyle();
                updatePreview();
            },
            crop: function() {
                updatePreview();
            }
        });
    }

    function changeCropStyle() {
        const selectedType = document.querySelector('input[name="modalCropType"]:checked').value;
        cropType = selectedType;

        if (cropper) {
            updateCropperStyle();
            updatePreview();
        }
    }

    function updateCropperStyle() {
        const container = document.querySelector('.crop-container');
        if (cropType === 'circle') {
            container.classList.add('crop-circle');
        } else {
            container.classList.remove('crop-circle');
        }
    }

    function updatePreview() {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 120,
            height: 120,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        const preview = document.getElementById('cropPreview');
        preview.innerHTML = '';

        if (canvas) {
            const previewImg = document.createElement('img');
            previewImg.src = canvas.toDataURL();
            previewImg.style.width = '100%';
            previewImg.style.height = '100%';
            previewImg.style.objectFit = 'cover';

            if (cropType === 'circle') {
                preview.style.borderRadius = '50%';
            } else {
                preview.style.borderRadius = '8px';
            }

            preview.appendChild(previewImg);
        }
    }

    function resetCrop() {
        if (cropper) {
            cropper.reset();
        }
    }

    function applyCrop() {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        if (canvas) {
            const dataURL = canvas.toDataURL('image/jpeg', 0.9);

            // Debug logging
            console.log('Applying crop:', {
                dataURLLength: dataURL.length,
                cropType: cropType,
                hasProfilePreview: !!document.getElementById('profilePreview'),
                hasCroppedImageData: !!document.getElementById('croppedImageData')
            });

            // Store the cropped image data
            const croppedImageField = document.getElementById('croppedImageData');
            if (croppedImageField) {
                croppedImageField.value = dataURL;
                console.log('Cropped image data stored, length:', dataURL.length);
            } else {
                console.error('croppedImageData field not found!');
            }

            // Update the preview in the main modal
            const profilePreview = document.getElementById('profilePreview');
            if (profilePreview) {
                profilePreview.src = dataURL;

                if (cropType === 'circle') {
                    profilePreview.className = 'img-fluid rounded-circle mb-2';
                } else {
                    profilePreview.className = 'img-fluid rounded mb-2';
                }
                console.log('Profile preview updated');
            } else {
                console.error('profilePreview element not found!');
            }

            // Close the cropper modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('imageCropperModal'));
            modal.hide();

            // Reset the file input
            document.getElementById('profile_pic').value = '';

            // Show success message
            showToast('Image cropped successfully!', 'success');
        } else {
            console.error('Failed to get cropped canvas');
        }
    }    function cancelCrop() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        // Reset file input
        document.getElementById('profile_pic').value = '';
        document.getElementById('croppedImageData').value = '';

        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('imageCropperModal'));
        if (modal) {
            modal.hide();
        }
    }

    function showToast(message, type = 'info') {
        // Create toast if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        const toastEl = document.createElement('div');
        toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');

        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        toastContainer.appendChild(toastEl);

        const toast = new bootstrap.Toast(toastEl);
        toast.show();

        // Remove toast element after it's hidden
        toastEl.addEventListener('hidden.bs.toast', function() {
            toastEl.remove();
        });
    }

    // Clean up on modal close
    document.getElementById('imageCropperModal').addEventListener('hidden.bs.modal', function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    });

    // Debug form submission
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('#editProfileModal form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const croppedImageData = document.getElementById('croppedImageData').value;
                console.log('Form submission debug:', {
                    hasCroppedImageData: !!croppedImageData,
                    croppedImageDataLength: croppedImageData ? croppedImageData.length : 0,
                    formData: new FormData(form)
                });

                // Log all form data
                const formData = new FormData(form);
                for (let [key, value] of formData.entries()) {
                    if (key === 'cropped_image') {
                        console.log(key + ':', value ? `Base64 data (${value.length} chars)` : 'empty');
                    } else {
                        console.log(key + ':', value);
                    }
                }
            });
        }
    });
</script>
