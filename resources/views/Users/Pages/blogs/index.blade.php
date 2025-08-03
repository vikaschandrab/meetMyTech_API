@extends('Users.Layouts.app')

@section('title', 'My Blogs | ' . Auth::user()->name)

@push('styles')
<style>
    .blog-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .blog-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-left-color: #007bff;
    }
    
    .blog-meta {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .blog-title {
        color: #495057;
        font-weight: 600;
    }
    
    .blog-status {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-draft {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
    }
    
    .status-published {
        background: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }
    
    .status-archived {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c2c7;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .stats-card {
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .search-filters {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .blog-excerpt {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 3rem;
        line-height: 1.5;
    }
    
    .featured-badge {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background: linear-gradient(45deg, #ffc107, #fd7e14);
        color: white;
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    {{-- Header Section --}}
    <div class="mb-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 d-inline align-middle">My Blogs</h1>
                <p class="text-muted mb-0">Create, manage and publish your blog posts</p>
            </div>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                <i data-feather="plus" class="feather-sm me-1"></i>
                Create New Blog
            </a>
        </div>

        {{-- Statistics Cards --}}
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="file-text" class="feather-lg text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $stats['total'] ?? 0 }}</h3>
                                <p class="text-muted mb-0">Total Blogs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="eye" class="feather-lg text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $stats['published'] ?? 0 }}</h3>
                                <p class="text-muted mb-0">Published</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="edit" class="feather-lg text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $stats['draft'] ?? 0 }}</h3>
                                <p class="text-muted mb-0">Drafts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i data-feather="star" class="feather-lg text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ $stats['featured'] ?? 0 }}</h3>
                                <p class="text-muted mb-0">Featured</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search and Filters --}}
        <div class="search-filters">
            <form method="GET" action="{{ route('blogs.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" 
                           class="form-control" 
                           id="search" 
                           name="search" 
                           value="{{ $filters['search'] ?? '' }}" 
                           placeholder="Search by title or content...">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">All Statuses</option>
                        <option value="published" {{ ($filters['status'] ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ ($filters['status'] ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ ($filters['status'] ?? '') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="is_featured" class="form-label">Featured</label>
                    <select class="form-select" id="is_featured" name="is_featured">
                        <option value="">All Blogs</option>
                        <option value="1" {{ ($filters['is_featured'] ?? '') === '1' ? 'selected' : '' }}>Featured Only</option>
                        <option value="0" {{ ($filters['is_featured'] ?? '') === '0' ? 'selected' : '' }}>Not Featured</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="sort_by" class="form-label">Sort By</label>
                    <select class="form-select" id="sort_by" name="sort_by">
                        <option value="created_at" {{ ($filters['sort_by'] ?? 'created_at') === 'created_at' ? 'selected' : '' }}>Created Date</option>
                        <option value="updated_at" {{ ($filters['sort_by'] ?? '') === 'updated_at' ? 'selected' : '' }}>Updated Date</option>
                        <option value="title" {{ ($filters['sort_by'] ?? '') === 'title' ? 'selected' : '' }}>Title</option>
                        <option value="views_count" {{ ($filters['sort_by'] ?? '') === 'views_count' ? 'selected' : '' }}>Views</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-outline-primary me-2">
                        <i data-feather="search" class="feather-sm me-1"></i>
                        Filter
                    </button>
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary">
                        <i data-feather="refresh-cw" class="feather-sm"></i>
                    </a>
                </div>
            </form>
        </div>

        {{-- Blog List --}}
        @if($hasBlogs)
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card blog-card h-100 position-relative">
                            @if($blog->is_featured)
                                <div class="featured-badge">
                                    <i data-feather="star" class="feather-sm me-1"></i>Featured
                                </div>
                            @endif
                            
                            <div class="card-body">
                                {{-- Header with Status --}}
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title blog-title mb-1">
                                            <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none">
                                                {{ $blog->title }}
                                            </a>
                                        </h6>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="blog-status status-{{ $blog->status }}">
                                                {{ ucfirst($blog->status) }}
                                            </span>
                                            @if($blog->published_at)
                                                <small class="text-muted">
                                                    <i data-feather="calendar" class="feather-sm me-1"></i>
                                                    {{ $blog->published_at->format('M d, Y') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i data-feather="more-horizontal"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('blogs.show', $blog->slug) }}">
                                                    <i data-feather="eye" class="feather-sm me-2"></i>View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('blogs.edit', $blog->slug) }}">
                                                    <i data-feather="edit" class="feather-sm me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('blogs.duplicate', $blog->slug) }}">
                                                    <i data-feather="copy" class="feather-sm me-2"></i>Duplicate
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('blogs.toggle-featured', $blog->slug) }}">
                                                    <i data-feather="star" class="feather-sm me-2"></i>
                                                    {{ $blog->is_featured ? 'Remove Featured' : 'Mark Featured' }}
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('blogs.destroy', $blog->slug) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i data-feather="trash-2" class="feather-sm me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                {{-- Blog Description --}}
                                @if($blog->description)
                                    <p class="text-muted blog-excerpt mb-3">{{ $blog->description }}</p>
                                @endif

                                {{-- Blog Stats --}}
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-3">
                                        <small class="text-muted">
                                            <i data-feather="eye" class="feather-sm me-1"></i>
                                            {{ $blog->views_count ?? 0 }} views
                                        </small>
                                        @if($blog->tags && count($blog->tags) > 0)
                                            <small class="text-muted">
                                                <i data-feather="tag" class="feather-sm me-1"></i>
                                                {{ count($blog->tags) }} tags
                                            </small>
                                        @endif
                                    </div>
                                    <small class="text-muted">
                                        Updated {{ $blog->updated_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $blogs->withQueryString()->links() }}
            </div>
        @else
            {{-- Empty State --}}
            <div class="card">
                <div class="card-body empty-state">
                    <i data-feather="file-text"></i>
                    <h5>No Blogs Yet</h5>
                    <p class="text-muted">Start sharing your thoughts and ideas with the world.</p>
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                        <i data-feather="plus" class="feather-sm me-1"></i>
                        Create Your First Blog
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
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

{{-- Delete Confirmation --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete forms with SweetAlert
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this blog post!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
