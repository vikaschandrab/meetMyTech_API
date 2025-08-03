@extends('Users.Layouts.app')

@section('title', 'Edit Blog: ' . $blog->title . ' | ' . Auth::user()->name)

@push('styles')
<style>
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc3545;
    }
    
    .is-invalid {
        border-color: #dc3545;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6.7.7-1.4 1.4 1.4 1.4-.7.7L4.4 6l1.4-1.4z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
    
    .help-text {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    
    .tag-input {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.375rem;
        min-height: 2.5rem;
        background: white;
    }
    
    .tag-item {
        background: #e9ecef;
        color: #495057;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        margin: 0.125rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .tag-remove {
        background: none;
        border: none;
        color: #6c757d;
        font-size: 0.75rem;
        cursor: pointer;
        padding: 0;
        margin: 0;
        width: 1rem;
        height: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .tag-remove:hover {
        color: #dc3545;
    }
    
    .preview-toggle {
        position: sticky;
        top: 1rem;
        z-index: 10;
    }
    
    .editor-container {
        min-height: 300px;
    }
    
    .preview-content {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        min-height: 300px;
    }
    
    .status-options {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .status-option {
        flex: 1;
        min-width: 200px;
    }
    
    .status-card {
        border: 2px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }
    
    .status-card:hover {
        border-color: #007bff;
        transform: translateY(-2px);
    }
    
    .status-card.selected {
        border-color: #007bff;
        background: #f8f9fa;
    }
    
    .status-card input[type="radio"] {
        display: none;
    }
    
    .status-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }
    
    .draft-icon {
        background: #f8f9fa;
        color: #6c757d;
    }
    
    .published-icon {
        background: #d1e7dd;
        color: #0f5132;
    }
    
    .archived-icon {
        background: #f8d7da;
        color: #721c24;
    }
    
    .blog-meta {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .current-featured-image {
        max-width: 200px;
        border-radius: 0.375rem;
        border: 1px solid #dee2e6;
    }
    
    .revision-history {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .revision-item {
        padding: 0.5rem;
        border-bottom: 1px solid #eee;
    }
    
    .revision-item:last-child {
        border-bottom: none;
    }
    
    .unsaved-changes {
        color: #ffc107;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 d-inline align-middle">Edit Blog</h1>
                    <p class="text-muted mb-0">Editing: <strong>{{ $blog->title }}</strong></p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-outline-info">
                        <i data-feather="eye" class="feather-sm me-1"></i>
                        Preview
                    </a>
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary">
                        <i data-feather="arrow-left" class="feather-sm me-1"></i>
                        Back to Blogs
                    </a>
                </div>
            </div>

            {{-- Blog Meta Information --}}
            <div class="blog-meta">
                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted">Created:</small><br>
                        <strong>{{ $blog->created_at->format('M d, Y H:i') }}</strong>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Last Updated:</small><br>
                        <strong>{{ $blog->updated_at->format('M d, Y H:i') }}</strong>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Status:</small><br>
                        <span class="badge bg-{{ $blog->status === 'published' ? 'success' : ($blog->status === 'draft' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($blog->status) }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">Views:</small><br>
                        <strong>{{ $blog->views_count ?? 0 }}</strong>
                    </div>
                </div>
            </div>

            {{-- Blog Edit Form --}}
            <form action="{{ route('blogs.update', $blog->slug) }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    Blog Content
                                    <span id="unsavedChanges" class="unsaved-changes ms-2" style="display: none;">
                                        <i data-feather="alert-circle" class="feather-sm"></i>
                                        Unsaved changes
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                {{-- Title --}}
                                <div class="form-group">
                                    <label for="title" class="form-label">
                                        Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $blog->title) }}" 
                                           placeholder="Enter blog title..."
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="help-text">A compelling title helps attract readers</div>
                                </div>

                                {{-- Slug (if different from auto-generated) --}}
                                <div class="form-group">
                                    <label for="slug" class="form-label">URL Slug</label>
                                    <div class="input-group">
                                        <span class="input-group-text">{{ url('/blog/') }}/</span>
                                        <input type="text" 
                                               class="form-control @error('slug') is-invalid @enderror" 
                                               id="slug" 
                                               name="slug" 
                                               value="{{ old('slug', $blog->slug) }}" 
                                               placeholder="url-friendly-slug">
                                    </div>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="help-text">Leave empty to auto-generate from title</div>
                                </div>

                                {{-- Description --}}
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="3" 
                                              placeholder="Brief description of your blog...">{{ old('description', $blog->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="help-text">Optional: A brief summary that appears in previews</div>
                                </div>

                                {{-- Content Editor --}}
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label for="content" class="form-label mb-0">
                                            Content <span class="text-danger">*</span>
                                        </label>
                                        <div class="preview-toggle">
                                            <div class="btn-group" role="group">
                                                <input type="radio" class="btn-check" name="editorMode" id="writeMode" checked>
                                                <label class="btn btn-outline-primary btn-sm" for="writeMode">Write</label>
                                                
                                                <input type="radio" class="btn-check" name="editorMode" id="previewMode">
                                                <label class="btn btn-outline-primary btn-sm" for="previewMode">Preview</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="editor-container">
                                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                                  id="content" 
                                                  name="content" 
                                                  rows="15" 
                                                  placeholder="Start writing your blog content..."
                                                  required>{{ old('content', $blog->content) }}</textarea>
                                        
                                        <div id="contentPreview" class="preview-content" style="display: none;">
                                            <div class="text-muted text-center py-5">
                                                <i data-feather="file-text" class="feather-lg mb-2"></i>
                                                <p>Content preview will appear here</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="help-text">Support for Markdown formatting available</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        {{-- Blog Settings --}}
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Publishing Settings</h6>
                            </div>
                            <div class="card-body">
                                {{-- Status Selection --}}
                                <div class="form-group">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <div class="status-options">
                                        <div class="status-option">
                                            <label class="status-card {{ old('status', $blog->status) === 'draft' ? 'selected' : '' }}" for="status_draft">
                                                <input type="radio" 
                                                       id="status_draft" 
                                                       name="status" 
                                                       value="draft" 
                                                       {{ old('status', $blog->status) === 'draft' ? 'checked' : '' }}>
                                                <div class="status-icon draft-icon">
                                                    <i data-feather="edit" class="feather-sm"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Draft</h6>
                                                    <small class="text-muted">Keep as draft</small>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="status-option">
                                            <label class="status-card {{ old('status', $blog->status) === 'published' ? 'selected' : '' }}" for="status_published">
                                                <input type="radio" 
                                                       id="status_published" 
                                                       name="status" 
                                                       value="published" 
                                                       {{ old('status', $blog->status) === 'published' ? 'checked' : '' }}>
                                                <div class="status-icon published-icon">
                                                    <i data-feather="globe" class="feather-sm"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Published</h6>
                                                    <small class="text-muted">Make it live</small>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="status-option">
                                            <label class="status-card {{ old('status', $blog->status) === 'archived' ? 'selected' : '' }}" for="status_archived">
                                                <input type="radio" 
                                                       id="status_archived" 
                                                       name="status" 
                                                       value="archived" 
                                                       {{ old('status', $blog->status) === 'archived' ? 'checked' : '' }}>
                                                <div class="status-icon archived-icon">
                                                    <i data-feather="archive" class="feather-sm"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Archived</h6>
                                                    <small class="text-muted">Hide from public</small>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Published Date --}}
                                <div class="form-group" id="publishDateGroup" style="{{ old('status', $blog->status) === 'published' ? 'block' : 'none' }}">
                                    <label for="published_at" class="form-label">Publish Date</label>
                                    <input type="datetime-local" 
                                           class="form-control @error('published_at') is-invalid @enderror" 
                                           id="published_at" 
                                           name="published_at" 
                                           value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                                    @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="help-text">Leave empty to use current time</div>
                                </div>

                                {{-- Featured Toggle --}}
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input @error('is_featured') is-invalid @enderror" 
                                               type="checkbox" 
                                               id="is_featured" 
                                               name="is_featured" 
                                               value="1" 
                                               {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            <strong>Featured Blog</strong>
                                        </label>
                                    </div>
                                    @error('is_featured')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="help-text">Featured blogs appear prominently</div>
                                </div>
                            </div>
                        </div>

                        {{-- Tags --}}
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Tags</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tags" class="form-label">Add Tags</label>
                                    <div class="tag-input @error('tags') is-invalid @enderror" id="tagContainer">
                                        <div id="tagList"></div>
                                        <input type="text" 
                                               id="tagInput" 
                                               placeholder="Type and press Enter..."
                                               style="border: none; outline: none; background: none; flex: 1; min-width: 120px;">
                                    </div>
                                    <input type="hidden" name="tags" id="tagsHidden" value="{{ old('tags', json_encode($blog->tags ?? [])) }}">
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="help-text">Press Enter to add tags. Help readers discover your content.</div>
                                </div>
                            </div>
                        </div>

                        {{-- Featured Image --}}
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Featured Image</h6>
                            </div>
                            <div class="card-body">
                                @if($blog->featured_image)
                                    <div class="mb-3">
                                        <label class="form-label">Current Image:</label><br>
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                             alt="Current featured image" 
                                             class="current-featured-image">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="remove_featured_image" name="remove_featured_image" value="1">
                                            <label class="form-check-label text-danger" for="remove_featured_image">
                                                Remove current image
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <label for="featured_image" class="form-label">
                                        {{ $blog->featured_image ? 'Replace Image' : 'Upload Image' }}
                                    </label>
                                    <input type="file" 
                                           class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" 
                                           name="featured_image" 
                                           accept="image/*">
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="help-text">Recommended: 1200x630px, max 2MB</div>
                                    
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="removeImage">
                                            <i data-feather="x" class="feather-sm me-1"></i>Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" name="action" value="save">
                                        <i data-feather="save" class="feather-sm me-1"></i>
                                        Update Blog
                                    </button>
                                    <button type="submit" class="btn btn-outline-secondary" name="action" value="save_continue">
                                        <i data-feather="edit" class="feather-sm me-1"></i>
                                        Save & Continue Editing
                                    </button>
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-outline-info">
                                        <i data-feather="eye" class="feather-sm me-1"></i>
                                        Preview Changes
                                    </a>
                                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-danger">
                                        <i data-feather="x" class="feather-sm me-1"></i>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Track form changes for unsaved changes warning
    const form = document.getElementById('blogForm');
    const unsavedIndicator = document.getElementById('unsavedChanges');
    let formChanged = false;
    let originalFormData = new FormData(form);

    function checkForChanges() {
        const currentFormData = new FormData(form);
        let hasChanges = false;
        
        for (let [key, value] of currentFormData.entries()) {
            if (originalFormData.get(key) !== value) {
                hasChanges = true;
                break;
            }
        }
        
        if (hasChanges && !formChanged) {
            formChanged = true;
            unsavedIndicator.style.display = 'inline';
        } else if (!hasChanges && formChanged) {
            formChanged = false;
            unsavedIndicator.style.display = 'none';
        }
    }

    // Monitor form changes
    form.addEventListener('input', checkForChanges);
    form.addEventListener('change', checkForChanges);

    // Warn before leaving page with unsaved changes
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Tag management
    const tagInput = document.getElementById('tagInput');
    const tagList = document.getElementById('tagList');
    const tagsHidden = document.getElementById('tagsHidden');
    let tags = [];

    // Load existing tags
    if (tagsHidden.value) {
        try {
            tags = JSON.parse(tagsHidden.value);
            renderTags();
        } catch (e) {
            tags = [];
        }
    }

    function renderTags() {
        tagList.innerHTML = '';
        tags.forEach((tag, index) => {
            const tagElement = document.createElement('span');
            tagElement.className = 'tag-item';
            tagElement.innerHTML = `
                ${tag}
                <button type="button" class="tag-remove" data-index="${index}">×</button>
            `;
            tagList.appendChild(tagElement);
        });
        tagsHidden.value = JSON.stringify(tags);
    }

    function addTag(tag) {
        tag = tag.trim().toLowerCase();
        if (tag && !tags.includes(tag)) {
            tags.push(tag);
            renderTags();
        }
        tagInput.value = '';
    }

    function removeTag(index) {
        tags.splice(index, 1);
        renderTags();
    }

    tagInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTag(this.value);
        }
    });

    tagList.addEventListener('click', function(e) {
        if (e.target.classList.contains('tag-remove')) {
            removeTag(parseInt(e.target.dataset.index));
        }
    });

    // Status selection
    const statusCards = document.querySelectorAll('.status-card');
    const publishDateGroup = document.getElementById('publishDateGroup');

    statusCards.forEach(card => {
        card.addEventListener('click', function() {
            statusCards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            
            // Show/hide publish date based on status
            if (radio.value === 'published') {
                publishDateGroup.style.display = 'block';
            } else {
                publishDateGroup.style.display = 'none';
            }
        });
    });

    // Image preview
    const featuredImage = document.getElementById('featured_image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const removeImage = document.getElementById('removeImage');

    featuredImage.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    removeImage.addEventListener('click', function() {
        featuredImage.value = '';
        imagePreview.style.display = 'none';
        previewImg.src = '';
    });

    // Content preview toggle
    const writeMode = document.getElementById('writeMode');
    const previewMode = document.getElementById('previewMode');
    const contentTextarea = document.getElementById('content');
    const contentPreview = document.getElementById('contentPreview');

    function updatePreview() {
        const content = contentTextarea.value;
        if (content.trim()) {
            // Simple markdown-like preview (you can integrate a proper markdown parser)
            let html = content
                .replace(/\n/g, '<br>')
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/`(.*?)`/g, '<code>$1</code>');
            contentPreview.innerHTML = html;
        } else {
            contentPreview.innerHTML = `
                <div class="text-muted text-center py-5">
                    <i data-feather="file-text" class="feather-lg mb-2"></i>
                    <p>Content preview will appear here</p>
                </div>
            `;
        }
        // Re-initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    writeMode.addEventListener('change', function() {
        if (this.checked) {
            contentTextarea.style.display = 'block';
            contentPreview.style.display = 'none';
        }
    });

    previewMode.addEventListener('change', function() {
        if (this.checked) {
            updatePreview();
            contentTextarea.style.display = 'none';
            contentPreview.style.display = 'block';
        }
    });

    contentTextarea.addEventListener('input', updatePreview);

    // Auto-save functionality (optional)
    let autoSaveTimeout;
    function autoSave() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            const formData = new FormData(form);
            formData.append('auto_save', '1');
            
            // You can implement auto-save API call here
            console.log('Auto-saving...');
        }, 30000); // Auto-save every 30 seconds
    }

    // Initialize auto-save on content change
    contentTextarea.addEventListener('input', autoSave);
    document.getElementById('title').addEventListener('input', autoSave);

    // Form submission handling
    form.addEventListener('submit', function(e) {
        // Clear unsaved changes flag when submitting
        formChanged = false;
        
        // Basic validation
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        
        if (!title || !content) {
            e.preventDefault();
            Swal.fire({
                title: 'Required Fields Missing',
                text: 'Please fill in both title and content fields.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return false;
        }

        // Show loading state
        const submitBtn = e.submitter;
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-1"></i>Updating...';
        }
    });
});
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
@endpush
