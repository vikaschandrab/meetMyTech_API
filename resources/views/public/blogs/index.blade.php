@extends('layouts.portfolio')

@section('title', 'Our Blog')

@section('content')
<div class="container mt-5 mb-5">
    <!-- Blog Header --@endsection

<style>
/* Blog Cards */
.blog-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Badge Styles */
.badge-outline-primary {
    color: #007bff;
    border: 1px solid #007bff;
    background: transparent;
}

/* Search Form */
.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

/* Tags */
.tags .badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

/* Card Title Hover */
.card-title a:hover {
    color: #007bff !important;
}

/* No Results Icon */
.fa-5x {
    font-size: 4rem !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .display-3 {
        font-size: 2.5rem;
    }

    .card-img-top {
        height: 180px !important;
    }
}

@media (max-width: 576px) {
    .col-lg-4, .col-md-6 {
        margin-bottom: 1.5rem;
    }
}
</style>"row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-3 font-weight-bold mb-4">Our Blog</h1>
            <p class="lead text-muted">
                Discover insights, tips, and stories from our community of tech professionals.
            </p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-5">
        <div class="col-12">
            <form method="GET" action="{{ route('public.blogs.index') }}" class="card p-4">
                <div class="row align-items-end">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="search" class="form-label">Search Blogs</label>
                        <input
                            type="text"
                            name="search"
                            id="search"
                            value="{{ $filters['search'] ?? '' }}"
                            placeholder="Search blogs..."
                            class="form-control"
                        >
                    </div>

                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="sort_by" class="form-label">Sort By</label>
                        <select name="sort_by" id="sort_by" class="form-control">
                            <option value="published_at" {{ ($filters['sort_by'] ?? '') == 'published_at' ? 'selected' : '' }}>Latest</option>
                            <option value="views_count" {{ ($filters['sort_by'] ?? '') == 'views_count' ? 'selected' : '' }}>Most Viewed</option>
                            <option value="title" {{ ($filters['sort_by'] ?? '') == 'title' ? 'selected' : '' }}>Title</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
            </div>

    <!-- Blog Grid -->
    @if($blogs->count() > 0)
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-4">
                    <article class="card h-100 shadow-sm blog-card">
                        @if($blog->featured_image)
                            <img
                                src="{{ asset('storage/' . $blog->featured_image) }}"
                                alt="{{ $blog->title }}"
                                class="card-img-top"
                                style="height: 200px; object-fit: cover;"
                            >
                        @else
                            <div class="card-img-top bg-gradient d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-white h3 font-weight-bold">{{ substr($blog->title, 0, 1) }}</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <div class="blog-meta mb-3">
                                <span class="badge badge-outline-primary mr-2">{{ $blog->user->name }}</span>
                                <small class="text-muted">
                                    {{ $blog->published_at->format('M j, Y') }} • {{ $blog->views_count }} views
                                </small>
                            </div>

                            <h5 class="card-title">
                                <a href="{{ route('public.blogs.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                    {{ $blog->title }}
                                </a>
                            </h5>

                            @if($blog->excerpt)
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit($blog->excerpt, 120) }}</p>
                            @endif

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a
                                        href="{{ route('public.blogs.show', $blog->slug) }}"
                                        class="btn btn-outline-primary btn-sm"
                                    >
                                        Read more <i class="fa fa-arrow-right"></i>
                                    </a>

                                    @if($blog->tags && count($blog->tags) > 0)
                                        <div class="tags">
                                            @foreach(array_slice($blog->tags, 0, 2) as $tag)
                                                <span class="badge badge-light">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-4">
                {{ $blogs->withQueryString()->links() }}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fa fa-file-text-o fa-5x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">No blogs found</h4>
                    <p class="text-muted">
                        @if($filters['search'] ?? false)
                            Try adjusting your search terms or
                            <a href="{{ route('public.blogs.index') }}" class="text-primary">view all blogs</a>.
                        @else
                            Check back soon for new content!
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
