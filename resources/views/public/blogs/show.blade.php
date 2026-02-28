@extends('layouts.portfolio')

@section('title', $blog->meta_title ?: ($blog->title . ' - ' . $blog->user->name . ' | ' . config('app.name')))

@push('meta')
<!-- Cache Control Headers -->
@php
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
@endphp

<!-- Primary Meta Tags -->
<meta name="title" content="{{ $blog->meta_title ?: ($blog->title . ' - ' . $blog->user->name . ' | ' . config('app.name')) }}">
<meta name="description" content="{{ $blog->description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 155)) }}">
<meta name="keywords" content="{{ $blog->keywords ?: ($blog->tags ? implode(', ', $blog->tags) . ', ' . $blog->user->name . ', blog, article, ' . config('app.name') : $blog->user->name . ', blog, article, ' . config('app.name')) }}">
<meta name="author" content="{{ $blog->user->name }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="language" content="en">
<meta name="revisit-after" content="7 days">

<!-- Force cache busting for social media -->
<meta property="fb:app_id" content="{{ config('services.facebook.app_id', '') }}">
<meta property="og:updated_time" content="{{ $blog->updated_at->timestamp }}">
<meta name="timestamp" content="{{ time() }}">

<!-- Force image refresh -->
<meta property="og:image:cache_buster" content="{{ time() }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ request()->url() }}">

@php
    // Debug information
    Log::info('Blog Share Debug Info', [
        'blog_id' => $blog->id,
        'blog_title' => $blog->title,
        'author_id' => $blog->user->id,
        'author_name' => $blog->user->name,
        'featured_image' => $blog->featured_image,
        'author_photo' => $blog->user->profile_photo_path,
        'url' => request()->url()
    ]);

    // Get the absolute URL for images with strict checking
    $baseUrl = rtrim(config('app.url'), '/');
    $imageUrl = '';
    $defaultLogo = $baseUrl . '/meetmytech_logo.jpg';
    $meetMytechFavicon = $baseUrl . '/favicon.ico';

    $featuredImagePath = $blog->featured_image;

    // Debug the featured image path (guard null/empty)
    Log::info('Featured image debug', [
        'raw_path' => $featuredImagePath,
        'storage_exists' => $featuredImagePath ? Storage::disk('public')->exists($featuredImagePath) : false,
        'full_storage_url' => $featuredImagePath ? Storage::disk('public')->url($featuredImagePath) : null,
        'base_url' => $baseUrl
    ]);

    // Build the featured image URL if it exists
    if ($featuredImagePath && Storage::disk('public')->exists($featuredImagePath)) {
        // Get the correct storage URL and ensure proper encoding
        $storageUrl = Storage::disk('public')->url($featuredImagePath);
        $imageUrl = $baseUrl . $storageUrl;

        // URL encode any spaces in the path
        $imageUrl = str_replace(' ', '%20', $imageUrl);

        Log::info('Using featured image', [
            'original_path' => $featuredImagePath,
            'final_url' => $imageUrl
        ]);
    } else {
        // Fallback to default logo
        $imageUrl = $defaultLogo;
        Log::info('Using default logo', ['url' => $imageUrl]);
    }

    // Final URL cleanup (avoid remote calls here to keep response fast)
    // Ensure URL is properly encoded
    $imageUrl = str_replace(' ', '%20', $imageUrl);

    // Force HTTPS in production
    if (app()->environment('production')) {
        $imageUrl = preg_replace('/^http:/', 'https:', $imageUrl);
    }
@endphp

<!-- Debug Comment for Image Source -->
<!-- Using Image: {{ $imageUrl }} -->
<!-- Author: {{ $blog->user->name }} -->
<!-- Blog ID: {{ $blog->id }} -->

<!-- Force No Cache Headers -->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ url('/meetmytech_logo.jpg') }}">
<meta name="msapplication-TileImage" content="{{ url('/meetmytech_logo.jpg') }}">

<!-- Generic Social Media Meta Tags with Version -->
<meta property="og:type" content="article">
<meta property="og:url" content="{{ request()->url() }}?v={{ time() }}">
<meta property="og:title" content="{{ $blog->meta_title ?: $blog->title }}">
<meta property="og:description" content="{{ $blog->description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 155)) }}">
<meta property="og:image" content="{{ str_replace(' ', '%20', $imageUrl) }}?v={{ time() }}">
<meta property="og:image:secure_url" content="{{ str_replace(' ', '%20', $imageUrl) }}?v={{ time() }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $blog->title }} by {{ $blog->user->name }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="en_US">

<!-- WhatsApp Specific -->
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- LinkedIn Specific -->
<meta property="linkedin:image" content="{{ $imageUrl }}?v={{ time() }}">
<meta property="linkedin:title" content="{{ $blog->meta_title ?: $blog->title }}">
<meta property="linkedin:description" content="{{ $blog->description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 155)) }}">
<meta name="image" content="{{ $imageUrl }}?v={{ time() }}">

<!-- Article specific Open Graph -->
<meta property="article:published_time" content="{{ $blog->published_at ? $blog->published_at->toISOString() : $blog->created_at->toISOString() }}">
<meta property="article:modified_time" content="{{ $blog->updated_at->toISOString() }}">
<meta property="article:author" content="{{ $blog->user->name }}">
<meta property="og:author" content="{{ $blog->user->name }}">
<meta property="article:section" content="Technology">
@if($blog->tags)
    @foreach($blog->tags as $tag)
        <meta property="article:tag" content="{{ $tag }}">
    @endforeach
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@meetmytech">
<meta name="twitter:creator" content="{{ '@' . str_replace(' ', '', strtolower($blog->user->name)) }}">
<meta name="twitter:url" content="{{ request()->url() }}?v={{ time() }}">
<meta name="twitter:title" content="{{ $blog->meta_title ?: $blog->title }}">
<meta name="twitter:description" content="{{ $blog->description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 155)) }}">
<meta name="twitter:image" content="{{ $imageUrl }}?v={{ time() }}">
<meta name="twitter:image:alt" content="{{ $blog->title }} by {{ $blog->user->name }}">
<meta name="twitter:creator" content="@{{ str_replace(' ', '', strtolower($blog->user->name)) }}">
<meta name="twitter:site" content="@meetmytech">

<!-- Additional SEO Meta Tags -->
<meta name="theme-color" content="#007bff">
<meta name="msapplication-TileColor" content="#007bff">

<!-- Performance optimization -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="//www.google.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

<!-- Preload critical resources -->
@if($blog->featured_image)
<link rel="preload" href="{{ asset('storage/' . $blog->featured_image) }}" as="image">
@endif

<!-- Schema.org JSON-LD structured data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ request()->url() }}"
  },
  "headline": "{{ $blog->meta_title ?: $blog->title }}",
  "description": "{{ $blog->description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 155)) }}",
  "image": {
    "@type": "ImageObject",
    "url": "{{ $imageUrl }}?v={{ time() }}",
    "width": 1200,
    "height": 630
  },
  "author": {
    "@type": "Person",
    "name": "{{ $blog->user->name }}",
    "url": "{{ url('https://' . str_replace(' ', '', strtolower($blog->user->name)) . '.' . config('app.domain')) }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ config('app.name') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('assets/images/logo.png') }}",
      "width": 60,
      "height": 60
    }
  },
  "datePublished": "{{ $blog->published_at ? $blog->published_at->toISOString() : $blog->created_at->toISOString() }}",
  "dateModified": "{{ $blog->updated_at->toISOString() }}",
  "wordCount": {{ str_word_count(strip_tags($blog->content)) }},
  "timeRequired": "PT{{ $blog->reading_time ?? ceil(str_word_count(strip_tags($blog->content)) / 200) }}M",
  "keywords": "{{ $blog->keywords ?: ($blog->tags ? implode(', ', $blog->tags) : '') }}",
  "articleSection": "{{ $blog->tags ? $blog->tags[0] : 'Technology' }}",
  "inLanguage": "en-US",
  "isAccessibleForFree": true,
  "url": "{{ request()->url() }}",
  "interactionStatistic": [
    {
      "@type": "InteractionCounter",
      "interactionType": "https://schema.org/ReadAction",
      "userInteractionCount": {{ $blog->views_count ?? 0 }}
    },
    {
      "@type": "InteractionCounter",
      "interactionType": "https://schema.org/CommentAction",
      "userInteractionCount": {{ count($comments) }}
    }
  ]
}
</script>

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ config('app.url') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "All Blogs",
      "item": "{{ route('home.all-blogs') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "{{ $blog->user->name }}'s Profile",
      "item": "{{ url('https://' . str_replace(' ', '', strtolower($blog->user->name)) . '.' . config('app.domain')) }}"
    },
    {
      "@type": "ListItem",
      "position": 4,
      "name": "{{ $blog->title }}",
      "item": "{{ request()->url() }}"
    }
  ]
}
</script>
@endpush

@push('styles')
<!-- Google reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="{{ asset('css/blog-show.css') }}">

<!-- Critical CSS for performance -->
<style>
/* Critical above-the-fold styles */
.container { max-width: 1140px; margin: 0 auto; padding: 0 15px; }
.row { display: flex; flex-wrap: wrap; margin: 0 -15px; }
.col-12, .col-lg-10 { flex: 0 0 100%; max-width: 100%; padding: 0 15px; }
.col-lg-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
.justify-content-center { justify-content: center !important; }
.mt-5 { margin-top: 3rem !important; }
.mb-5 { margin-bottom: 3rem !important; }
.mb-4 { margin-bottom: 1.5rem !important; }
.display-4 { font-size: 2.5rem; font-weight: 300; line-height: 1.2; }
.font-weight-bold { font-weight: 700 !important; }
.btn { display: inline-block; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; text-align: center; text-decoration: none; border: 1px solid transparent; border-radius: 0.375rem; transition: all 0.15s ease-in-out; }
.btn-outline-primary { color: #007bff; border-color: #007bff; background-color: transparent; }
.btn-outline-primary:hover { color: #fff; background-color: #007bff; border-color: #007bff; }
.img-fluid { max-width: 100%; height: auto; }
.rounded { border-radius: 0.375rem !important; }
.shadow-lg { box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important; }
@media (min-width: 992px) { .col-lg-10 { flex: 0 0 83.333333%; max-width: 83.333333%; } }
</style>


@endpush

@section('content')
@php
    $authorUrl = 'https://' . $blog->user->slug . '.' . config('app.domain');
    $authorProfilePicUrl = $blog->user->profilePic ? asset('storage/' . $blog->user->profilePic) : null;
@endphp
<div class="blog-page" id="blogPage" data-subscribe-url="{{ route('blog.subscribe') }}">
<div class="blog-hero" style="background-image: url('{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('meetmytech_logo.jpg') }}');">
    <div class="blog-hero-overlay"></div>
    <div class="container">
        <div class="blog-hero-inner">
            <a href="{{ $backInfo['url'] }}" class="btn btn-light btn-sm blog-back-btn">
                <i class="fa fa-arrow-left"></i> {{ $backInfo['label'] }}
            </a>
            <h1 class="blog-hero-title">{{ $blog->title }}</h1>
            <div class="blog-hero-meta">
                <div class="blog-author">
                    <div class="author-avatar">
                        @if($authorProfilePicUrl)
                            <img src="{{ $authorProfilePicUrl }}" alt="{{ $blog->user->name }}" class="author-avatar-img" loading="lazy" decoding="async">
                        @else
                            {{ strtoupper(substr($blog->user->name, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <a href="{{ $authorUrl }}" class="author-name">{{ $blog->user->name }}</a>
                        <div class="author-role">Author</div>
                    </div>
                </div>
                <div class="blog-meta-row">
                    <span><i class="fa fa-calendar"></i> {{ $blog->published_at->format('F j, Y') }}</span>
                    <span><i class="fa fa-eye"></i> {{ $blog->views_count }} {{ Str::plural('view', $blog->views_count) }}</span>
                    @if($blog->reading_time)
                        <span><i class="fa fa-clock-o"></i> {{ $blog->reading_time }} min read</span>
                    @endif
                </div>
            </div>
            @if($blog->tags && count($blog->tags) > 0)
                <div class="blog-hero-tags">
                    @foreach($blog->tags as $tag)
                        <span class="badge badge-light">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<div class="container blog-body">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($blog->excerpt)
                <div class="blog-excerpt">
                    {{ $blog->excerpt }}
                </div>
            @endif

            <div class="blog-content mb-5">
                {!! $blog->content !!}
            </div>

            <div class="blog-share-row">
                <div class="share-left">
                    <span class="share-title">Share this article</span>
                    <div class="share-buttons">
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" class="share-btn twitter" rel="noopener noreferrer">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn facebook" rel="noopener noreferrer">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="share-btn linkedin" rel="noopener noreferrer">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . request()->url()) }}" target="_blank" class="share-btn whatsapp" rel="noopener noreferrer">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div class="share-right">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#commentModal">
                        <i class="fas fa-comment me-2"></i>Comment
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#subscriptionModal">
                        <i class="fas fa-bell me-2"></i>Subscribe
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <aside class="blog-sidebar">
                <div class="sidebar-card">
                    <h6>About the author</h6>
                    <div class="d-flex align-items-center mt-3">
                        <div class="author-avatar me-3">
                            @if($authorProfilePicUrl)
                                <img src="{{ $authorProfilePicUrl }}" alt="{{ $blog->user->name }}" class="author-avatar-img" loading="lazy" decoding="async">
                            @else
                                {{ strtoupper(substr($blog->user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div>
                            <a href="{{ $authorUrl }}" class="author-name">{{ $blog->user->name }}</a>
                            <div class="author-role">Contributor</div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-card">
                    <h6>Article stats</h6>
                    <ul class="stats-list">
                        <li><i class="fa fa-eye"></i> {{ $blog->views_count }} views</li>
                        <li><i class="fa fa-comments"></i> {{ count($comments) }} comments</li>
                        <li><i class="fa fa-calendar"></i> {{ $blog->published_at->format('M d, Y') }}</li>
                    </ul>
                </div>
            </aside>
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

{{-- Comments Display Section --}}
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Comments Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <h3 class="mb-0 me-3">
                        <i class="fas fa-comments text-primary me-2"></i>
                        Comments
                    </h3>
                    <span class="badge bg-secondary">{{ count($comments) }}</span>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">
                    <i class="fas fa-plus me-2"></i>Add Comment
                </button>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">
                                <i class="fas fa-comment me-2"></i>Add First Comment
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content elegant-modal">
            <div class="modal-header elegant-header">
                <div class="modal-icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="modal-title-section">
                    <h5 class="modal-title elegant-title" id="commentModalLabel">
                        Share Your Thoughts
                    </h5>
                    <p class="modal-subtitle">Join the conversation and let us know what you think</p>
                </div>
                <button type="button" class="btn-close elegant-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body elegant-body">
                @if(session('success'))
                    <div class="alert elegant-alert elegant-alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert elegant-alert elegant-alert-error alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('blogs.comments.store', $blog->slug) }}" method="POST" class="elegant-form" id="commentForm">
                    @csrf
                    <div class="elegant-form-group">
                        <label for="modal_user_name" class="elegant-label">
                            <i class="fas fa-user me-2"></i>
                            Your Name <span class="required-star">*</span>
                        </label>
                        <div class="elegant-input-wrapper">
                            <input type="text" class="elegant-input @error('user_name') is-invalid @enderror"
                                   id="modal_user_name" name="user_name" value="{{ old('user_name') }}"
                                   placeholder="Enter your full name" required maxlength="255">
                            <div class="input-focus-line"></div>
                        </div>
                        @error('user_name')
                            <div class="elegant-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="elegant-form-group">
                        <label for="modal_message" class="elegant-label">
                            <i class="fas fa-comment-dots me-2"></i>
                            Your Comment <span class="required-star">*</span>
                        </label>
                        <div class="elegant-input-wrapper">
                            <textarea class="elegant-textarea @error('message') is-invalid @enderror"
                                      id="modal_message" name="message" rows="6"
                                      placeholder="Share your thoughts, insights, or questions about this blog post..."
                                      required maxlength="1000">{{ old('message') }}</textarea>
                            <div class="input-focus-line"></div>
                        </div>
                        @error('message')
                            <div class="elegant-error">{{ $message }}</div>
                        @enderror
                        <div class="elegant-form-footer">
                            <small class="elegant-hint">
                                <i class="fas fa-lightbulb me-1"></i>
                                Be respectful and constructive in your comments
                            </small>
                            <small class="elegant-counter" id="modalCharCount">0/1000</small>
                        </div>
                    </div>

                    <!-- Honeypot (Anti-spam) -->
                    @honeypot

                    <!-- Google reCAPTCHA -->
                    @if(!app()->environment('local') || !config('captcha.disable_in_local', false))
                        <div class="elegant-captcha">
                            <div class="captcha-wrapper">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                            @error('g-recaptcha-response')
                                <div class="elegant-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <!-- CAPTCHA disabled for local development -->
                        <div class="alert alert-info text-center" style="font-size: 0.85rem; margin: 1rem 0;">
                            <i class="fas fa-info-circle me-2"></i>
                            CAPTCHA disabled for local development
                        </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer elegant-footer">
                <button type="button" class="btn elegant-btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" form="commentForm" class="btn elegant-btn-primary" id="modalSubmitBtn">
                    <i class="fas fa-paper-plane me-2"></i>
                    <span>Post Comment</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Subscription Modal -->
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content elegant-modal subscription-modal">
            <div class="modal-header subscription-header">
                <div class="subscription-icon-wrapper">
                    <div class="subscription-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="subscription-rings">
                        <div class="ring ring-1"></div>
                        <div class="ring ring-2"></div>
                        <div class="ring ring-3"></div>
                    </div>
                </div>
                <div class="subscription-title-section">
                    <h5 class="subscription-title">
                        Stay in the Loop
                    </h5>
                    <p class="subscription-subtitle">Get notified when we publish amazing new content</p>
                </div>
                <button type="button" class="btn-close elegant-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body subscription-body">
                <div class="subscription-intro">
                    <div class="intro-icon">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <h6 class="intro-title">Join Our Community</h6>
                    <p class="intro-text">
                        Be the first to know about our latest insights, tutorials, and industry updates.
                        No spam, just quality content delivered to your inbox.
                    </p>
                </div>

                <!-- Subscription Form -->
                <form id="modalSubscriptionForm" class="subscription-form-elegant">
                    @csrf
                    <div class="elegant-form-group">
                        <label for="modal_subscription_email" class="elegant-label">
                            <i class="fas fa-envelope me-2"></i>
                            Email Address
                        </label>
                        <div class="elegant-input-wrapper email-input">
                            <input type="email"
                                   class="elegant-input"
                                   id="modal_subscription_email"
                                   name="email"
                                   placeholder="your.email@example.com"
                                   required>
                            <div class="input-focus-line"></div>
                            <div class="email-icon">
                                <i class="fas fa-at"></i>
                            </div>
                        </div>
                        <div class="elegant-error" style="display: none;"></div>
                    </div>

                    <!-- reCAPTCHA -->
                    @if(!app()->environment('local'))
                    <div class="elegant-captcha subscription-captcha">
                        <div class="captcha-wrapper">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                        <div class="elegant-error" id="modalRecaptchaError" style="display: none;"></div>
                    </div>
                    @endif

                    <!-- Success/Error Messages -->
                    <div id="modalSubscriptionMessage" class="elegant-alert" style="display: none;"></div>
                </form>

                <!-- Features Grid -->
                <div class="subscription-features">
                    <div class="feature-item">
                        <div class="feature-icon rocket">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div class="feature-content">
                            <h6>Latest Content First</h6>
                            <p>Get exclusive early access to our newest posts</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon shield">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="feature-content">
                            <h6>Zero Spam Promise</h6>
                            <p>Only valuable content, never promotional junk</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon unsubscribe">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <div class="feature-content">
                            <h6>Easy Unsubscribe</h6>
                            <p>Leave anytime with a single click</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer subscription-footer">
                <button type="button" class="btn elegant-btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Maybe Later
                </button>
                <button type="submit" form="modalSubscriptionForm" class="btn elegant-btn-subscription" id="modalSubscribeBtn">
                    <div class="btn-content">
                        <i class="fas fa-bell me-2"></i>
                        <span class="btn-text">Subscribe Now</span>
                    </div>
                    <div class="btn-shimmer"></div>
                </button>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/blog-show.js') }}" defer></script>
@endpush



