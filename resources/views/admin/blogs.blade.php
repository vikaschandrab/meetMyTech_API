@extends('admin.layout')

@section('title', 'Blog Management')
@section('page-title', 'Blog Management')

@section('page-actions')
    <div class="btn-group">
        <a href="{{ route('admin.create-blog') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Create New Blog
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-blog me-2"></i>All Blogs</h6>
    </div>
    <div class="card-body">
        @if($blogs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>
                                    @if($blog->blog_image)
                                        <img src="{{ asset('storage/' . $blog->blog_image) }}"
                                             alt="{{ $blog->title }}"
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                             style="width: 60px; height: 60px; border-radius: 8px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <h6 class="mb-1">{{ Str::limit($blog->title, 50) }}</h6>
                                    <small class="text-muted">{{ Str::limit(strip_tags($blog->description), 80) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $blog->status === 'active' ? 'success' : 'warning' }}">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $blog->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.edit-blog', $blog->id) }}"
                                           class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteBlog({{ $blog->id }})" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No blogs found</h5>
                <p class="text-muted">Create your first blog to get started.</p>
                <a href="{{ route('admin.create-blog') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Create New Blog
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function deleteBlog(blogId) {
    if (!confirm('Are you sure you want to delete this blog? This action cannot be undone.')) {
        return;
    }

    fetch(`/admin/blogs/${blogId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error deleting blog');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error deleting blog');
    });
}
</script>
@endsection
