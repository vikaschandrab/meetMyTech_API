@extends('Users.Layouts.app')

@section('title', 'Site Settings | ' . Auth::user()->name)

@push('styles')
<style>
    /* Navigation specific styles */
    .wrapper {
        display: flex !important;
    }
    
    .main {
        flex: 1 1 auto !important;
        display: flex !important;
        flex-direction: column !important;
    }
    
    .navbar {
        display: block !important;
    }
    
    .sidebar {
        display: block !important;
    }
    
    /* Site Settings specific styles */
    .logo-preview {
        max-width: 150px;
        max-height: 150px;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 200px;
        background-color: #f8f9fa;
    }
    
    .logo-format-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 1rem;
    }
    
    .logo-format-item {
        text-align: center;
        padding: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background: white;
    }
    
    .logo-format-item img {
        max-width: 50px;
        max-height: 50px;
        object-fit: contain;
        margin-bottom: 0.5rem;
    }
    
    .settings-card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: box-shadow 0.15s ease-in-out;
    }
    
    .settings-card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .main-logo-container {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .main-logo-container img {
        width: 128px;
        height: 128px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #e9ecef;
        padding: 4px;
        background: white;
    }
    
    .settings-section {
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        border-left: 4px solid #007bff;
        padding-left: 0.75rem;
    }
    
    .info-card {
        background: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .btn-action {
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .modal-body .form-label {
        font-weight: 600;
        color: #495057;
    }
    
    .modal-body .text-muted {
        font-size: 0.875rem;
    }
    
    .current-logos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .current-logo-item {
        text-align: center;
        padding: 0.75rem;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        background: white;
    }
    
    .current-logo-item img {
        max-width: 40px;
        max-height: 40px;
        object-fit: contain;
        margin-bottom: 0.5rem;
    }
    
    .current-logo-item .small {
        font-size: 0.75rem;
        line-height: 1.2;
    }
    
    .tawk-code-preview {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        font-family: 'Monaco', 'Consolas', 'Courier New', monospace;
        font-size: 0.85rem;
        color: #495057;
        overflow-x: auto;
        max-height: 200px;
        overflow-y: auto;
    }
    
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
    }
    
    .integration-status {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 0.5rem;
        border-left: 4px solid #007bff;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 d-inline align-middle">Site Settings</h1>
            <p class="text-muted mb-0">Configure your site's branding and SEO settings</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#editSiteSettingsModal">
                <i data-feather="edit" class="feather-sm me-1"></i>
                Edit Settings
            </button>
            @if($siteSetting)
                <button type="button" class="btn btn-outline-danger btn-action" onclick="deleteSiteSettings()">
                    <i data-feather="trash-2" class="feather-sm me-1"></i>
                    Reset Settings
                </button>
            @endif
        </div>
    </div>

    {{-- Main Logo Display --}}
    <div class="row">
        <div class="col-12">
            <div class="card settings-card mb-4">
                <div class="card-body">
                    <div class="main-logo-container">
                        @php
                            $defaultLogo = 'dashboard_css/img/avatars/avatar-4.jpg';
                            $mainLogo = $siteSetting && $siteSetting->logo_png 
                                ? asset('storage/' . $siteSetting->logo_png) 
                                : asset($defaultLogo);
                        @endphp
                        <img src="{{ $mainLogo }}" alt="{{ Auth::user()->name }}" class="mb-3">
                        <h5 class="card-title mb-0">Site Logo</h5>
                        <p class="text-muted">Main branding logo displayed across your site</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Settings Information --}}
    <div class="row">
        <div class="col-lg-6">
            <div class="card settings-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i data-feather="search" class="feather-sm me-2"></i>
                        SEO Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="settings-section">
                        <div class="section-title">Meta Description</div>
                        <div class="info-card">
                            {{ $siteSetting->seo_description ?? 'No SEO meta description set. Click Edit to add one.' }}
                        </div>
                    </div>
                    
                    <div class="settings-section">
                        <div class="section-title">Meta Keywords</div>
                        <div class="info-card">
                            {{ $siteSetting->seo_keywords ?? 'No SEO meta keywords set. Click Edit to add them.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card settings-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i data-feather="image" class="feather-sm me-2"></i>
                        Logo Formats
                    </h5>
                </div>
                <div class="card-body">
                    @if($siteSetting && $siteSetting->logo_png)
                        @php
                            $logoFormats = [
                                'logo_png' => ['name' => 'Main Logo', 'size' => '256×256'],
                                'logo_72_72_png' => ['name' => 'Mobile', 'size' => '72×72'],
                                'logo_114_114_png' => ['name' => 'Retina', 'size' => '114×114'],
                                'logo_69_64_png' => ['name' => 'Custom', 'size' => '69×64'],
                                'logo_16_14_png' => ['name' => 'Small', 'size' => '16×14'],
                                'logo_16_14_ico' => ['name' => 'Favicon', 'size' => '16×14'],
                            ];
                        @endphp
                        <div class="current-logos-grid">
                            @foreach($logoFormats as $field => $format)
                                @if($siteSetting->$field)
                                    <div class="current-logo-item">
                                        <img src="{{ asset('storage/' . $siteSetting->$field) }}" alt="{{ $format['name'] }}">
                                        <div class="small text-muted">{{ $format['name'] }}</div>
                                        <div class="small text-muted">{{ $format['size'] }}</div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i data-feather="image" class="feather-lg text-muted mb-2"></i>
                            <p class="text-muted">No logo formats available. Upload a logo to generate all required sizes.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Integration Status --}}
    <div class="row">
        <div class="col-12">
            <div class="card settings-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i data-feather="message-circle" class="feather-sm me-2"></i>
                        Live Chat Integration
                    </h5>
                </div>
                <div class="card-body">
                    <div class="settings-section">
                        <div class="section-title">Tawk.to Live Chat</div>
                        @if($siteSetting && $siteSetting->tawk_js)
                            <div class="integration-status">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success status-badge me-2">
                                        <i data-feather="check-circle" class="feather-sm me-1"></i>
                                        Active
                                    </span>
                                    <span class="text-muted">Live chat widget is enabled and active on your site</span>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleTawkPreview()">
                                    <i data-feather="eye" class="feather-sm me-1"></i>
                                    View Code
                                </button>
                            </div>
                            <div id="tawkCodePreview" class="mt-3" style="display: none;">
                                <div class="tawk-code-preview">{{ Str::limit($siteSetting->tawk_js, 300) }}@if(strlen($siteSetting->tawk_js) > 300)...@endif</div>
                            </div>
                        @else
                            <div class="integration-status">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-secondary status-badge me-2">
                                        <i data-feather="alert-circle" class="feather-sm me-1"></i>
                                        Not Configured
                                    </span>
                                    <span class="text-muted">No live chat widget configured. Click Edit Settings to add Tawk.to integration.</span>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editSiteSettingsModal">
                                    <i data-feather="plus" class="feather-sm me-1"></i>
                                    Configure Now
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Site Settings Modal --}}
<div class="modal fade" id="editSiteSettingsModal" tabindex="-1" aria-labelledby="editSiteSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('site-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editSiteSettingsModalLabel">
                        <i data-feather="settings" class="feather-sm me-2"></i>
                        Edit Site Settings
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Logo Upload Section --}}
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i data-feather="image" class="feather-sm me-2"></i>
                            Logo Upload
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Upload Logo Image</label>
                                <input type="file" name="main_logo" id="mainLogo" class="form-control" accept="image/*" onchange="previewMainLogo(event)">
                                <div class="form-text">
                                    Upload one high-quality image. We'll automatically generate all required sizes:
                                    <ul class="small mt-2 mb-0">
                                        <li>Main Logo (256×256)</li>
                                        <li>Mobile Icon (72×72)</li>
                                        <li>Retina Display (114×114)</li>
                                        <li>Custom Size (69×64)</li>
                                        <li>Small Favicon (16×14)</li>
                                        <li>ICO Favicon (16×14)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preview</label>
                                <div class="logo-preview" id="logoPreviewContainer">
                                    @if($siteSetting && $siteSetting->logo_png)
                                        <img id="logoPreview" src="{{ asset('storage/' . $siteSetting->logo_png) }}" alt="Current Logo" class="img-fluid">
                                    @else
                                        <div id="logoPreview" class="text-muted text-center">
                                            <i data-feather="image" class="feather-lg mb-2"></i>
                                            <div>No logo uploaded</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Current Logo Formats --}}
                    @if($siteSetting && $siteSetting->logo_png)
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i data-feather="grid" class="feather-sm me-2"></i>
                                Current Logo Formats
                            </h6>
                            <div class="current-logos-grid">
                                @foreach($logoFormats as $field => $format)
                                    @if($siteSetting->$field)
                                        <div class="current-logo-item">
                                            <img src="{{ asset('storage/' . $siteSetting->$field) }}" alt="{{ $format['name'] }}">
                                            <div class="small fw-bold">{{ $format['name'] }}</div>
                                            <div class="small text-muted">{{ $format['size'] }}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- SEO Section --}}
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i data-feather="search" class="feather-sm me-2"></i>
                            SEO Settings
                        </h6>
                        <div class="mb-3">
                            <label class="form-label">SEO Meta Description</label>
                            <textarea name="seo_description" class="form-control" rows="3" placeholder="Enter meta description for SEO">{{ $siteSetting->seo_description ?? '' }}</textarea>
                            <div class="form-text">Used in search engine results. Recommended: 150-160 characters.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">SEO Meta Keywords</label>
                            <textarea name="seo_keywords" class="form-control" rows="2" placeholder="Enter keywords separated by commas">{{ $siteSetting->seo_keywords ?? '' }}</textarea>
                            <div class="form-text">Separate keywords with commas. Example: web development, Laravel, PHP</div>
                        </div>
                    </div>

                    {{-- Tawk.to Integration Section --}}
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i data-feather="message-circle" class="feather-sm me-2"></i>
                            Live Chat Integration
                        </h6>
                        <div class="mb-3">
                            <label class="form-label">Tawk.to Live Chat JS Code</label>
                            <textarea name="tawk_js" class="form-control" rows="8" placeholder="Paste your tawk.to JavaScript code here">{{ $siteSetting->tawk_js ?? '' }}</textarea>
                            <div class="form-text">
                                <strong>How to get your Tawk.to code:</strong>
                                <ol class="small mt-2 mb-2">
                                    <li>Login to your <a href="https://dashboard.tawk.to" target="_blank">Tawk.to Dashboard</a></li>
                                    <li>Go to <strong>Admin → Chat Widget</strong></li>
                                    <li>Copy the entire JavaScript code snippet</li>
                                    <li>Paste it in the textarea above</li>
                                </ol>
                                <small class="text-muted">The code should start with <code>&lt;!--Start of Tawk.to Script--&gt;</code> and end with <code>&lt;!--End of Tawk.to Script--&gt;</code></small>
                            </div>
                        </div>
                        
                        @if($siteSetting && $siteSetting->tawk_js)
                            <div class="alert alert-success" role="alert">
                                <i data-feather="check-circle" class="feather-sm me-2"></i>
                                <strong>Current Status:</strong> Live chat is active and will appear on your site.
                            </div>
                        @else
                            <div class="alert alert-warning" role="alert">
                                <i data-feather="alert-triangle" class="feather-sm me-2"></i>
                                <strong>Not Configured:</strong> Add your Tawk.to code to enable live chat.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="save" class="feather-sm me-1"></i>
                        Save Changes
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i data-feather="x" class="feather-sm me-1"></i>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
    
    // Initialize Bootstrap tooltips and popovers
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});

function previewMainLogo(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('logoPreview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Logo Preview" class="img-fluid">`;
        }
        reader.readAsDataURL(file);
    }
}

function deleteSiteSettings() {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will delete all site settings and logo files. You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, reset settings!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("site-settings.delete") }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

function toggleTawkPreview() {
    const preview = document.getElementById('tawkCodePreview');
    const button = event.target.closest('button');
    const icon = button.querySelector('[data-feather]');
    
    if (preview.style.display === 'none') {
        preview.style.display = 'block';
        button.innerHTML = '<i data-feather="eye-off" class="feather-sm me-1"></i> Hide Code';
    } else {
        preview.style.display = 'none';
        button.innerHTML = '<i data-feather="eye" class="feather-sm me-1"></i> View Code';
    }
    
    // Re-initialize feather icons
    feather.replace();
}
</script>

{{-- Success/Error Messages --}}
@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if($errors->any())
<script>
    let errorMessages = '';
    @foreach($errors->all() as $error)
        errorMessages += '• {{ addslashes($error) }}\n';
    @endforeach

    Swal.fire({
        title: 'Validation Error!',
        text: errorMessages,
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endpush
