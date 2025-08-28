@extends('layouts.portfolio')

@section('title', $blog->title)

@push('styles')
<!-- Google reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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

    /* Comments Section Styling */
    .comments-section {
        background-color: #f8f9fa;
        padding: 2rem 0;
        border-radius: 15px;
        margin-top: 3rem;
    }

    .comment-form .card {
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 15px;
        overflow: hidden;
    }

    .comment-form .card-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        padding: 1.25rem 1.5rem;
    }

    .comment-form .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: #fff !important;
        color: #2c3e50 !important;
    }

    .comment-form .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        transform: translateY(-2px);
        background-color: #fff !important;
        color: #2c3e50 !important;
    }

    .comment-form .form-control::placeholder {
        color: #6c757d !important;
        opacity: 0.7;
    }

    .comment-form .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    .comment-form .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
    }

    /* Individual Comment Styling */
    .comment-item {
        animation: fadeInUp 0.6s ease;
        margin-bottom: 1.5rem;
    }

    .comment-item .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        background: #fff;
    }

    .comment-item .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .comment-item .card-body {
        padding: 1.5rem;
    }

    .comment-avatar {
        flex-shrink: 0;
    }

    .comment-avatar .rounded-circle {
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        border: 3px solid #fff;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }

    .comment-author {
        font-size: 16px;
        color: #007bff !important;
        font-weight: 700;
    }

    .comment-date {
        font-size: 13px;
        color: #6c757d;
        font-weight: 500;
    }

    .comment-message {
        margin-top: 0.75rem;
        line-height: 1.7;
        color: #2c3e50;
    }

    .comment-message p {
        font-size: 15px;
        margin-bottom: 0;
        word-wrap: break-word;
    }

    /* Empty comments state */
    .empty-comments {
        padding: 3rem 1rem;
        text-align: center;
    }

    .empty-comments i {
        display: block;
        margin-bottom: 1rem;
    }

    .empty-comments h5 {
        font-weight: 600;
        color: #6c757d;
    }

    /* Character counter styling */
    #charCount {
        font-weight: 600;
        transition: color 0.3s ease;
    }

    /* Form labels */
    .comment-form .form-label {
        color: #2c3e50;
        font-size: 14px;
        margin-bottom: 8px;
    }

    /* Alert styling */
    .comment-form .alert {
        border: none;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    .comment-form .alert-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .comment-form .alert-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Form input overrides to ensure visibility */
    .comment-form input[type="text"],
    .comment-form textarea {
        background-color: #ffffff !important;
        color: #2c3e50 !important;
        -webkit-text-fill-color: #2c3e50 !important;
    }

    .comment-form input[type="text"]:focus,
    .comment-form textarea:focus,
    .comment-form input[type="text"]:active,
    .comment-form textarea:active {
        background-color: #ffffff !important;
        color: #2c3e50 !important;
        -webkit-text-fill-color: #2c3e50 !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .comment-form .card-body {
            padding: 1.25rem;
        }

        .comment-item .card-body {
            padding: 1.25rem;
        }

        .comment-avatar .rounded-circle {
            width: 40px !important;
            height: 40px !important;
            font-size: 16px !important;
        }
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

{{-- Public Comments Section --}}
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Comments Header -->
            <div class="d-flex align-items-center mb-4">
                <h3 class="mb-0 me-3">
                    <i class="fas fa-comments text-primary me-2"></i>
                    Discussion & Comments
                </h3>
                <span class="badge bg-secondary">{{ count($comments) }}</span>
            </div>

            <!-- Comment Form -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-pen me-2"></i>
                        Join the Discussion
                    </h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('blogs.comments.store', $blog->slug) }}" method="POST" class="comment-form" id="commentForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="user_name" class="form-label fw-bold">
                                    <i class="fas fa-user me-1"></i>
                                    Your Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('user_name') is-invalid @enderror" 
                                       id="user_name" name="user_name" value="{{ old('user_name') }}" 
                                       placeholder="Enter your name" required maxlength="255"
                                       style="background-color: #fff !important; color: #2c3e50 !important;">
                                @error('user_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold">
                                <i class="fas fa-comment-dots me-1"></i>
                                Your Comment <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="4" 
                                      placeholder="Share your thoughts about this blog post..." 
                                      required maxlength="1000"
                                      style="background-color: #fff !important; color: #2c3e50 !important;">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="d-flex justify-content-between mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Be respectful and constructive in your comments
                                </small>
                                <small class="text-muted fw-bold" id="charCount">0/1000</small>
                            </div>
                        </div>

                        <!-- Honeypot (Anti-spam) -->
                        @honeypot

                        <!-- Google reCAPTCHA -->
                        <div class="mb-3 text-center">
                            <div class="d-flex justify-content-center">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                            @error('g-recaptcha-response')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i>Post Comment
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Comments Display -->
            <div class="comments-list">
                @forelse($comments as $comment)
                    <div class="comment-item mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <!-- Avatar -->
                                    <div class="comment-avatar me-3">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" 
                                             style="width: 48px; height: 48px; font-size: 18px;">
                                            {{ strtoupper(substr($comment->user_name, 0, 1)) }}
                                        </div>
                                    </div>
                                    
                                    <!-- Comment Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="comment-author mb-0 text-primary fw-bold">
                                                {{ $comment->user_name }}
                                            </h6>
                                            <small class="comment-date text-muted">
                                                <i class="fas fa-clock me-1"></i>
                                                {{ $comment->created_at->format('M d, Y \a\t g:i A') }}
                                            </small>
                                        </div>
                                        <div class="comment-message">
                                            <p class="mb-0 text-dark">{{ $comment->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="empty-comments">
                            <i class="fas fa-comments text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h5 class="text-muted mb-2">No comments yet</h5>
                            <p class="text-muted">Be the first to start the discussion!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character count for comment textarea
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    const submitBtn = document.getElementById('submitBtn');
    const commentForm = document.getElementById('commentForm');
    
    if (messageTextarea && charCount) {
        function updateCharCount() {
            const currentLength = messageTextarea.value.length;
            charCount.textContent = currentLength + '/1000';
            
            // Change color when approaching limit
            if (currentLength > 900) {
                charCount.classList.add('text-danger');
                charCount.classList.remove('text-warning', 'text-muted');
            } else if (currentLength > 800) {
                charCount.classList.add('text-warning');
                charCount.classList.remove('text-danger', 'text-muted');
            } else {
                charCount.classList.add('text-muted');
                charCount.classList.remove('text-danger', 'text-warning');
            }
        }
        
        // Update on input
        messageTextarea.addEventListener('input', updateCharCount);
        messageTextarea.addEventListener('keyup', updateCharCount);
        messageTextarea.addEventListener('paste', function() {
            setTimeout(updateCharCount, 10);
        });
        
        // Initial count (for old values)
        updateCharCount();
    }
    
    // Form submission handling
    if (commentForm && submitBtn) {
        commentForm.addEventListener('submit', function(e) {
            const userName = document.getElementById('user_name').value.trim();
            const message = messageTextarea.value.trim();
            
            if (!userName || !message) {
                e.preventDefault();
                alert('Please fill in both name and comment fields.');
                return false;
            }
            
            if (message.length > 1000) {
                e.preventDefault();
                alert('Comment is too long. Please keep it under 1000 characters.');
                return false;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Posting...';
        });
    }
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            if (bootstrap && bootstrap.Alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            } else {
                alert.style.display = 'none';
            }
        }, 5000);
    });
    
    // Fix for input visibility - ensure text is visible
    const formInputs = document.querySelectorAll('.comment-form input, .comment-form textarea');
    formInputs.forEach(function(input) {
        input.style.backgroundColor = '#fff';
        input.style.color = '#2c3e50';
        
        input.addEventListener('focus', function() {
            this.style.backgroundColor = '#fff';
            this.style.color = '#2c3e50';
        });
        
        input.addEventListener('input', function() {
            this.style.backgroundColor = '#fff';
            this.style.color = '#2c3e50';
        });
    });
});
</script>
@endpush
