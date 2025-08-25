@extends('admin.layout')

@section('title', 'Create Blog')
@section('page-title', 'Create New Blog')

@section('page-actions')
    <div class="btn-group">
        <a href="{{ route('admin.blogs') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Back to Blogs
        </a>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-plus me-2"></i>Create New Blog</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store-blog') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Blog Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="blog_image" class="form-label">Blog Image</label>
                        <input type="file" class="form-control @error('blog_image') is-invalid @enderror"
                               id="blog_image" name="blog_image" accept="image/*">
                        @error('blog_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Recommended size: 800x400 pixels. Maximum file size: 2MB.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Blog Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="10" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.blogs') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Create Blog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Add rich text editor if needed
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('blog_image');
    const preview = document.createElement('div');
    preview.className = 'mt-2';
    imageInput.parentNode.appendChild(preview);

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });
});
</script>
@endsection
