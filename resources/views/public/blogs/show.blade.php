@extends('layouts.portfolio')

@section('title', $blog->title)

@push('styles')
<style>
    /* TinyMCE Content Styling */
    .blog-content {
        line-height: 1.8;
        color: #333;
        font-size: 16px;
    }

    .blog-content h1, .blog-content h2, .blog-content h3, 
    .blog-content h4, .blog-content h5, .blog-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
        line-height: 1.25;
    }

    .blog-content h1 { font-size: 2.5rem; color: #2c3e50; }
    .blog-content h2 { font-size: 2rem; color: #34495e; }
    .blog-content h3 { font-size: 1.75rem; color: #34495e; }
    .blog-content h4 { font-size: 1.5rem; color: #34495e; }
    .blog-content h5 { font-size: 1.25rem; color: #34495e; }
    .blog-content h6 { font-size: 1.1rem; color: #34495e; }

    .blog-content p {
        margin-bottom: 1.5rem;
        text-align: justify;
    }

    .blog-content ul, .blog-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    .blog-content li {
        margin-bottom: 0.5rem;
    }

    .blog-content ul li {
        list-style-type: disc;
    }

    .blog-content ol li {
        list-style-type: decimal;
    }

    .blog-content blockquote {
        border-left: 4px solid #007bff;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        background-color: #f8f9fa;
        padding: 1rem 1rem 1rem 2rem;
        border-radius: 0.25rem;
    }

    .blog-content code {
        background-color: #f8f9fa;
        color: #e83e8c;
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        font-size: 0.9em;
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }

    .blog-content pre {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        overflow-x: auto;
        margin-bottom: 1.5rem;
    }

    .blog-content pre code {
        background-color: transparent;
        color: inherit;
        padding: 0;
        border-radius: 0;
    }

    .blog-content table {
        width: 100%;
        margin-bottom: 1.5rem;
        border-collapse: collapse;
        border: 1px solid #dee2e6;
    }

    .blog-content th, .blog-content td {
        padding: 0.75rem;
        border: 1px solid #dee2e6;
        text-align: left;
    }

    .blog-content th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        margin: 1.5rem 0;
        border-radius: 0.375rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .blog-content strong {
        font-weight: 600;
    }

    .blog-content em {
        font-style: italic;
    }

    .blog-content a {
        color: #007bff;
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: border-color 0.3s ease;
    }

    .blog-content a:hover {
        border-bottom-color: #007bff;
    }

    .blog-content hr {
        margin: 3rem 0;
        border: 0;
        border-top: 2px solid #dee2e6;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .blog-content {
            font-size: 15px;
        }
        
        .blog-content h1 { font-size: 2rem; }
        .blog-content h2 { font-size: 1.75rem; }
        .blog-content h3 { font-size: 1.5rem; }
        .blog-content h4 { font-size: 1.25rem; }
        .blog-content h5 { font-size: 1.1rem; }
        .blog-content h6 { font-size: 1rem; }
    }
</style>
@endpush

@section('content')
<div class="container mt-5 mb-5">
    <!-- Back to Blog Link -->
    <div class="row">
        <div class="col-12 mb-4">
            <a href="/{{ $blog->authorSlug }}" class="btn btn-outline-primary">
                <i class="fa fa-arrow-left"></i> Back to {{ $blog->user->name }}'s Profile
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <article class="blog-post">
                <!-- Blog Header -->
                <header class="mb-5">
                    <h1 class="display-4 font-weight-bold mb-4">
                        {{ $blog->title }}
                    </h1>

                    <!-- Author and Meta Information -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="author-avatar mr-3">
                                    {{ substr($blog->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-weight-bold h6 mb-0">{{ $blog->user->name }}</div>
                                    <small class="text-muted">Author</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-wrap blog-meta">
                                <span class="meta-item">
                                    <i class="fa fa-calendar"></i>
                                    <time datetime="{{ $blog->published_at }}">
                                        {{ $blog->published_at->format('F j, Y') }}
                                    </time>
                                </span>

                                <span class="meta-item">
                                    <i class="fa fa-eye"></i>
                                    {{ $blog->views_count }} {{ Str::plural('view', $blog->views_count) }}
                                </span>

                                @if($blog->reading_time)
                                    <span class="meta-item">
                                        <i class="fa fa-clock-o"></i>
                                        {{ $blog->reading_time }} min read
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    @if($blog->tags && count($blog->tags) > 0)
                        <div class="mb-4">
                            @foreach($blog->tags as $tag)
                                <span class="badge badge-primary mr-2 mb-2">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </header>

                <!-- Featured Image -->
                @if($blog->featured_image)
                    <div class="mb-5">
                        <img
                            src="{{ asset('storage/' . $blog->featured_image) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid rounded shadow-lg"
                        >
                    </div>
                @endif

                <!-- Blog Excerpt -->
                @if($blog->excerpt)
                    <div class="alert alert-info border-left-accent mb-5">
                        <h5 class="mb-0 font-italic">{{ $blog->excerpt }}</h5>
                    </div>
                @endif

                <!-- Blog Content -->
                <div class="blog-content mb-5">
                    {!! $blog->content !!}
                </div>

                <!-- Share Section -->
                <div class="border-top pt-4 mb-5">
                    <h5 class="font-weight-bold mb-3">Share this article</h5>
                    <div class="d-flex flex-wrap">
                        <a
                            href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}"
                            target="_blank"
                            class="btn btn-primary mr-2 mb-2"
                        >
                            <i class="fa fa-twitter"></i> Twitter
                        </a>

                        <a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                            target="_blank"
                            class="btn btn-primary mr-2 mb-2"
                        >
                            <i class="fa fa-facebook"></i> Facebook
                        </a>

                        <a
                            href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                            target="_blank"
                            class="btn btn-primary mr-2 mb-2"
                        >
                            <i class="fa fa-linkedin"></i> LinkedIn
                        </a>

                        <a
                            href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . request()->url()) }}"
                            target="_blank"
                            class="btn btn-success mr-2 mb-2"
                        >
                            <i class="fa fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <!-- Related Blogs -->
    @if($relatedBlogs->count() > 0)
        <div class="row">
            <div class="col-12">
                <section class="related-blogs mt-5">
                    <h3 class="h4 font-weight-bold mb-4">More from {{ $blog->user->name }}</h3>

                    <div class="row">
                        @foreach($relatedBlogs as $relatedBlog)
                            <div class="col-md-6 col-lg-{{ $relatedBlogs->count() > 2 ? '4' : '6' }} mb-4">
                                <article class="card h-100 shadow-sm hover-shadow">
                                    @if($relatedBlog->featured_image)
                                        <img
                                            src="{{ asset('storage/' . $relatedBlog->featured_image) }}"
                                            alt="{{ $relatedBlog->title }}"
                                            class="card-img-top"
                                            style="height: 200px; object-fit: cover;"
                                        >
                                    @else
                                        <div class="card-img-top bg-gradient d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <span class="text-white h3 font-weight-bold">{{ substr($relatedBlog->title, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <div class="text-muted small mb-2">
                                            {{ $relatedBlog->published_at->format('M j, Y') }}
                                        </div>

                                        <h5 class="card-title mb-2">
                                            <a href="{{ route('blogs.show', $relatedBlog->slug) }}" class="text-decoration-none">
                                                {{ $relatedBlog->title }}
                                            </a>
                                        </h5>

                                        @if($relatedBlog->excerpt)
                                            <p class="card-text text-muted small mb-0">
                                                {{ Str::limit($relatedBlog->excerpt, 100) }}
                                            </p>
                                        @endif
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    @endif
</div>

<style>
/* Hide skip link for accessibility unless focused */
.skip-link {
    position: absolute;
    top: -40px;
    left: 6px;
    z-index: 999999;
    color: #fff;
    background-color: #007bff;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 3px;
    transition: top 0.3s;
}

.skip-link:focus {
    top: 6px;
}

.visually-hidden-focusable {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border: 0 !important;
}

.visually-hidden-focusable:focus {
    position: static !important;
    width: auto !important;
    height: auto !important;
    padding: 8px 16px !important;
    margin: 0 !important;
    overflow: visible !important;
    clip: auto !important;
    white-space: normal !important;
}

/* Author Avatar */
.author-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 18px;
}

/* Blog Meta */
.blog-meta {
    gap: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    color: #6c757d;
    font-size: 14px;
    margin-right: 15px;
    margin-bottom: 5px;
}

.meta-item i {
    margin-right: 5px;
}

/* Border Left Accent */
.border-left-accent {
    border-left: 4px solid #007bff !important;
    background-color: #e7f3ff !important;
    border-color: #007bff !important;
}

/* Blog Content Styling */
.blog-content {
    font-size: 16px;
    line-height: 1.8;
    color: #333;
}

.blog-content h1, .blog-content h2, .blog-content h3,
.blog-content h4, .blog-content h5, .blog-content h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.blog-content p {
    margin-bottom: 1.5rem;
}

.blog-content a {
    color: #007bff;
    text-decoration: underline;
}

.blog-content a:hover {
    color: #0056b3;
}

.blog-content img {
    border-radius: 8px;
    margin: 2rem 0;
    max-width: 100%;
    height: auto;
}

.blog-content blockquote {
    border-left: 4px solid #e9ecef;
    padding-left: 1rem;
    font-style: italic;
    color: #6c757d;
    margin: 1.5rem 0;
}

.blog-content code {
    background-color: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
    color: #e83e8c;
}

.blog-content pre {
    background-color: #2d3748;
    color: #f7fafc;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.blog-content ul, .blog-content ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.blog-content li {
    margin-bottom: 0.5rem;
}

/* Related Blogs */
.related-blogs {
    background-color: transparent !important;
}

.related-blogs h3 {
    color: #333 !important;
    background-color: transparent !important;
}

.related-blogs .card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    background-color: #fff !important;
}

.related-blogs .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.related-blogs .card-body {
    background-color: #fff !important;
    color: #333 !important;
}

.related-blogs .card-title a {
    color: #333 !important;
    text-decoration: none;
}

.related-blogs .card-title a:hover {
    color: #007bff !important;
}

.related-blogs .card-text {
    color: #6c757d !important;
}

.related-blogs .text-muted {
    color: #6c757d !important;
}

.bg-gradient {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
}

/* Hover Shadow */
.hover-shadow:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .blog-meta {
        flex-direction: column;
        align-items: flex-start !important;
    }

    .meta-item {
        margin-bottom: 8px;
    }

    .author-avatar {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
}
</style>
@endsection
