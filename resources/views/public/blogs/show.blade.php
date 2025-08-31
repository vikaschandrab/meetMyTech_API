@extends('layouts.portfolio')

@section('title', $blog->meta_title ?: ($blog->title . ' - ' . $blog->user->name . ' | ' . config('app.name')))

@push('meta')
<!-- Primary Meta Tags -->
<meta name="title" content="{{ $blog->meta_title ?: ($blog->title . ' - ' . $blog->user->name . ' | ' . config('app.name')) }}">
<meta name="description" content="{{ $blog->description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 155)) }}">
<meta name="keywords" content="{{ $blog->keywords ?: ($blog->tags ? implode(', ', $blog->tags) . ', ' . $blog->user->name . ', blog, article, ' . config('app.name') : $blog->user->name . ', blog, article, ' . config('app.name')) }}">
<meta name="author" content="{{ $blog->user->name }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="language" content="en">
<meta name="revisit-after" content="7 days">

<!-- Canonical URL -->
<link rel="canonical" href="{{ request()->url() }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="{{ request()->url() }}">
<meta property="og:title" content="{{ $blog->meta_title ?: $blog->title }}">
<meta property="og:description" content="{{ $blog->description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 155)) }}">
<meta property="og:image" content="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : ($blog->user->profile_picture ? asset('storage/' . $blog->user->profile_picture) : asset('storage/default-avatar.png')) }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $blog->title }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="en_US">

<!-- Article specific Open Graph -->
<meta property="article:published_time" content="{{ $blog->published_at ? $blog->published_at->toISOString() : $blog->created_at->toISOString() }}">
<meta property="article:modified_time" content="{{ $blog->updated_at->toISOString() }}">
<meta property="article:author" content="{{ $blog->user->name }}">
<meta property="article:section" content="Technology">
@if($blog->tags)
    @foreach($blog->tags as $tag)
        <meta property="article:tag" content="{{ $tag }}">
    @endforeach
@endif

<!-- Twitter Card -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ request()->url() }}">
<meta property="twitter:title" content="{{ $blog->meta_title ?: $blog->title }}">
<meta property="twitter:description" content="{{ $blog->description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 155)) }}">
<meta property="twitter:image" content="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : ($blog->user->profile_picture ? asset('storage/' . $blog->user->profile_picture) : asset('storage/default-avatar.png')) }}">
<meta property="twitter:image:alt" content="{{ $blog->title }}">
<meta name="twitter:creator" content="@{{ str_replace(' ', '_', strtolower($blog->user->name)) }}">
<meta name="twitter:site" content="@{{ config('app.name') }}">

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
    "url": "{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : ($blog->user->profile_picture ? asset('storage/' . $blog->user->profile_picture) : asset('storage/default-avatar.png')) }}",
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

    /* Subscription form input visibility fixes */
    .subscription-form input[type="email"],
    .subscription-form input {
        background-color: #ffffff !important;
        color: #2c3e50 !important;
        -webkit-text-fill-color: #2c3e50 !important;
        border: 2px solid #dee2e6 !important;
        font-size: 16px !important;
        padding: 12px 16px !important;
        border-radius: 8px !important;
    }

    .subscription-form input[type="email"]:focus,
    .subscription-form input:focus {
        background-color: #ffffff !important;
        color: #2c3e50 !important;
        -webkit-text-fill-color: #2c3e50 !important;
        border-color: #007bff !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
        outline: none !important;
    }

    .subscription-form input::placeholder {
        color: #6c757d !important;
        opacity: 1 !important;
    }

    .subscription-form .form-label {
        color: #2c3e50 !important;
        font-weight: 600 !important;
        margin-bottom: 8px !important;
        display: block !important;
        font-size: 14px !important;
    }

    .subscription-form .form-label i {
        color: #007bff !important;
    }

    /* Subscription section text visibility */
    .subscription-section .lead,
    .subscription-section p {
        color: #2c3e50 !important;
        font-weight: 500 !important;
    }

    .subscription-section .text-muted {
        color: #495057 !important;
    }

    .subscription-section .card-body {
        background-color: #ffffff !important;
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

    /* Compact Share & Engage Section */
    .compact-share-engage-bar {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border: 1px solid #e9ecef;
        border-radius: 15px;
        padding: 1.5rem;
        margin: 2rem 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .compact-share-engage-bar:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .share-section, .engage-section {
        padding: 0.5rem 0;
    }

    .share-label, .engage-label {
        color: #2c3e50 !important;
        font-weight: 600 !important;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: block !important;
        visibility: visible !important;
    }

    .share-label i, .engage-label i {
        color: #007bff !important;
    }

    /* Compact Share Buttons */
    .share-buttons-compact {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .share-btn-compact {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #fff;
        transition: all 0.3s ease;
        font-size: 16px;
        position: relative;
        overflow: hidden;
    }

    .share-btn-compact::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.2);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .share-btn-compact:hover::before {
        opacity: 1;
    }

    .share-btn-compact:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        color: #fff;
        text-decoration: none;
    }

    .share-btn-compact.twitter {
        background: linear-gradient(135deg, #1DA1F2 0%, #0d8bd9 100%);
    }

    .share-btn-compact.facebook {
        background: linear-gradient(135deg, #4267B2 0%, #365899 100%);
    }

    .share-btn-compact.linkedin {
        background: linear-gradient(135deg, #0077B5 0%, #005885 100%);
    }

    .share-btn-compact.whatsapp {
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    }

    /* Compact Engage Buttons */
    .engage-buttons-compact {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .engage-btn-compact {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .engage-btn-compact:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .subscribe-compact {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff;
    }

    .subscribe-compact:hover {
        background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
        color: #fff;
    }

    .comment-compact {
        background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
        color: #fff;
    }

    .comment-compact:hover {
        background: linear-gradient(135deg, #0056b3 0%, #520dc2 100%);
        color: #fff;
    }

    /* Stats Bar */
    .stats-bar {
        margin-top: 1.25rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .stat-compact {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6c757d;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .stat-compact i {
        color: #007bff;
        font-size: 0.9rem;
    }

    /* Responsive Design for Compact Version */
    @media (max-width: 768px) {
        .compact-share-engage-bar {
            padding: 1rem;
            margin: 1.5rem 0;
        }

        .share-section, .engage-section {
            margin-bottom: 1rem;
            text-align: center;
        }

        .share-buttons-compact, .engage-buttons-compact {
            justify-content: center;
        }

        .stats-bar {
            gap: 1rem;
            justify-content: center;
        }

        .stat-compact {
            font-size: 0.8rem;
        }

        .share-btn-compact {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .engage-btn-compact {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
    }

    /* Animation */
    .compact-share-engage-bar {
        animation: fadeInUp 0.6s ease;
    }

    /* Elegant Modal Styles */
    .elegant-modal {
        border: none;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        backdrop-filter: blur(10px);
        max-width: 500px;
        margin: 1.75rem auto;
    }

    .elegant-modal .modal-header {
        border: none;
        padding: 1.5rem 1.5rem 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .elegant-modal .modal-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
    }

    .modal-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-right: 1rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .modal-title-section {
        flex: 1;
    }

    .elegant-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0 0 0.25rem 0;
        color: white;
    }

    .modal-subtitle {
        font-size: 0.85rem;
        opacity: 0.9;
        margin: 0;
        color: rgba(255, 255, 255, 0.8);
    }

    .elegant-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 8px;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        font-size: 14px;
    }

    .elegant-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .elegant-body {
        padding: 1.5rem;
        background: #fafbfc;
    }

    .elegant-form-group {
        margin-bottom: 1.25rem;
    }

    .elegant-label {
        display: block;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .required-star {
        color: #e74c3c;
        margin-left: 0.25rem;
    }

    .elegant-input-wrapper {
        position: relative;
    }

    .elegant-input, .elegant-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        background: white;
        color: #2c3e50;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        outline: none;
        font-family: inherit;
    }

    .elegant-input:focus, .elegant-textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .elegant-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .input-focus-line {
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 3px;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .elegant-input:focus + .input-focus-line,
    .elegant-textarea:focus + .input-focus-line {
        width: 100%;
    }

    .elegant-form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
    }

    .elegant-hint {
        color: #6c757d;
        font-size: 0.8rem;
    }

    .elegant-counter {
        color: #667eea;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .elegant-error {
        color: #e74c3c;
        font-size: 0.8rem;
        margin-top: 0.4rem;
        display: block;
    }

    .elegant-captcha {
        text-align: center;
        margin: 1.25rem 0;
    }

    .captcha-wrapper {
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .elegant-alert {
        padding: 0.875rem 1rem;
        border-radius: 10px;
        border: none;
        margin: 0.875rem 0;
        font-size: 0.85rem;
    }

    .elegant-alert-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .elegant-alert-error {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .elegant-footer {
        padding: 1.25rem 1.5rem 1.5rem;
        border: none;
        background: #fafbfc;
        gap: 0.75rem;
    }

    .elegant-btn-secondary {
        background: #e9ecef;
        color: #6c757d;
        border: none;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .elegant-btn-secondary:hover {
        background: #dee2e6;
        color: #495057;
        transform: translateY(-2px);
    }

    .elegant-btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        font-size: 0.9rem;
    }

    .elegant-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
        color: white;
    }

    /* Subscription Modal Specific Styles */
    .subscription-modal .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        text-align: center;
        padding: 1.5rem;
    }

    .subscription-icon-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .subscription-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        position: relative;
        z-index: 2;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .subscription-rings {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .ring {
        position: absolute;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .ring-1 {
        width: 80px;
        height: 80px;
        animation: pulse 2s infinite;
    }

    .ring-2 {
        width: 100px;
        height: 100px;
        animation: pulse 2s infinite 0.5s;
    }

    .ring-3 {
        width: 120px;
        height: 120px;
        animation: pulse 2s infinite 1s;
    }

    @keyframes pulse {
        0% {
            opacity: 1;
            transform: translate(-50%, -50%) scale(0.8);
        }
        70% {
            opacity: 0.3;
            transform: translate(-50%, -50%) scale(1.2);
        }
        100% {
            opacity: 0;
            transform: translate(-50%, -50%) scale(1.4);
        }
    }

    .subscription-title-section {
        text-align: center;
    }

    .subscription-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        color: white;
    }

    .subscription-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        margin: 0;
        color: rgba(255, 255, 255, 0.8);
    }

    .subscription-body {
        padding: 1.5rem;
        background: linear-gradient(135deg, #fafbfc 0%, #f8f9fa 100%);
    }

    .subscription-intro {
        text-align: center;
        margin-bottom: 1.5rem;
        padding: 1.25rem;
        background: white !important;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .intro-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
        margin: 0 auto 0.875rem;
    }

    .intro-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50 !important;
        margin-bottom: 0.5rem;
    }

    .intro-text {
        color: #495057 !important;
        line-height: 1.6;
        margin: 0;
        font-size: 0.9rem;
        font-weight: 500 !important;
    }

    .email-input {
        position: relative;
    }

    .email-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .elegant-input:focus ~ .email-icon {
        color: #667eea;
    }

    .subscription-features {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        padding: 0.875rem;
        background: white !important;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-right: 0.875rem;
        color: white;
    }

    .feature-icon.rocket {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    }

    .feature-icon.shield {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .feature-icon.unsubscribe {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .feature-content h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #2c3e50 !important;
        margin-bottom: 0.25rem;
    }

    .feature-content p {
        font-size: 0.8rem;
        color: #495057 !important;
        margin: 0;
        font-weight: 500 !important;
    }

    .subscription-footer {
        padding: 1.25rem 1.5rem 1.5rem;
        background: linear-gradient(135deg, #fafbfc 0%, #f8f9fa 100%);
        border: none;
        gap: 0.75rem;
    }

    .elegant-btn-subscription {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        font-size: 0.9rem;
    }

    .elegant-btn-subscription:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .btn-shimmer {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .elegant-btn-subscription:hover .btn-shimmer {
        left: 100%;
    }

    /* Responsive adjustments for modals */
    @media (max-width: 768px) {
        .elegant-modal {
            margin: 1rem;
            max-width: calc(100% - 2rem);
        }

        .elegant-modal .modal-header,
        .elegant-body,
        .elegant-footer {
            padding: 1.25rem;
        }

        .subscription-features {
            gap: 0.5rem;
        }

        .feature-item {
            padding: 0.625rem;
        }

        .feature-icon {
            width: 35px;
            height: 35px;
            font-size: 14px;
            margin-right: 0.75rem;
        }

        .modal-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .elegant-title {
            font-size: 1.1rem;
        }

        .subscription-title {
            font-size: 1.25rem;
        }

        .intro-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
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
            <a href="{{ $backInfo['url'] }}" class="btn btn-outline-primary">
                <i class="fa fa-arrow-left"></i> {{ $backInfo['label'] }}
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

                <!-- Compact Share & Engage Section -->
                <div class="compact-share-engage-bar">
                    <div class="row align-items-center">
                        <!-- Share Section -->
                        <div class="col-md-6">
                            <div class="share-section">
                                <h6 class="share-label">
                                    <i class="fas fa-share-alt me-2"></i>Share this article
                                </h6>
                                <div class="share-buttons-compact">
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}"
                                       target="_blank"
                                       class="share-btn-compact twitter"
                                       title="Share on Twitter"
                                       data-bs-toggle="tooltip">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                       target="_blank"
                                       class="share-btn-compact facebook"
                                       title="Share on Facebook"
                                       data-bs-toggle="tooltip">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                       target="_blank"
                                       class="share-btn-compact linkedin"
                                       title="Share on LinkedIn"
                                       data-bs-toggle="tooltip">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . request()->url()) }}"
                                       target="_blank"
                                       class="share-btn-compact whatsapp"
                                       title="Share on WhatsApp"
                                       data-bs-toggle="tooltip">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Engage Section -->
                        <div class="col-md-6">
                            <div class="engage-section">
                                <h6 class="engage-label">
                                    <i class="fas fa-heart me-2"></i>Join the conversation
                                </h6>
                                <div class="engage-buttons-compact">
                                    <button type="button"
                                            class="engage-btn-compact subscribe-compact"
                                            data-bs-toggle="modal"
                                            data-bs-target="#subscriptionModal"
                                            title="Subscribe to updates"
                                            data-bs-toggle="tooltip">
                                        <i class="fas fa-bell me-1"></i>
                                        <span>Subscribe</span>
                                    </button>
                                    <button type="button"
                                            class="engage-btn-compact comment-compact"
                                            data-bs-toggle="modal"
                                            data-bs-target="#commentModal"
                                            title="Add a comment"
                                            data-bs-toggle="tooltip">
                                        <i class="fas fa-comment me-1"></i>
                                        <span>Comment</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Bar -->
                    <div class="stats-bar">
                        <div class="stat-compact">
                            <i class="fas fa-eye"></i>
                            <span>{{ $blog->views_count }} views</span>
                        </div>
                        <div class="stat-compact">
                            <i class="fas fa-comments"></i>
                            <span>{{ count($comments) }} comments</span>
                        </div>
                        <div class="stat-compact">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $blog->published_at->format('M d, Y') }}</span>
                        </div>
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
                    <div class="elegant-captcha">
                        <div class="captcha-wrapper">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                        @error('g-recaptcha-response')
                            <div class="elegant-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
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
                    <div class="elegant-captcha subscription-captcha">
                        <div class="captcha-wrapper">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                        <div class="elegant-error" id="modalRecaptchaError" style="display: none;"></div>
                    </div>

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
    // Character count for comment textarea (both original and modal)
    const messageTextareas = ['message', 'modal_message'];
    const charCounts = ['charCount', 'modalCharCount'];

    messageTextareas.forEach((textareaId, index) => {
        const textarea = document.getElementById(textareaId);
        const charCount = document.getElementById(charCounts[index]);

        if (textarea && charCount) {
            function updateCharCount() {
                const currentLength = textarea.value.length;
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
            textarea.addEventListener('input', updateCharCount);
            textarea.addEventListener('keyup', updateCharCount);
            textarea.addEventListener('paste', function() {
                setTimeout(updateCharCount, 10);
            });

            // Initial count
            updateCharCount();
        }
    });

    // Form submission handling for modal comment form
    const commentForm = document.getElementById('commentForm');
    const modalSubmitBtn = document.getElementById('modalSubmitBtn');

    if (commentForm && modalSubmitBtn) {
        commentForm.addEventListener('submit', function(e) {
            const userName = document.getElementById('modal_user_name').value.trim();
            const message = document.getElementById('modal_message').value.trim();

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
            modalSubmitBtn.disabled = true;
            modalSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Posting...';
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
    const formInputs = document.querySelectorAll('.comment-form input, .comment-form textarea, .subscription-form input');
    formInputs.forEach(function(input) {
        input.style.backgroundColor = '#fff';
        input.style.color = '#2c3e50';
        input.style.webkitTextFillColor = '#2c3e50';

        input.addEventListener('focus', function() {
            this.style.backgroundColor = '#fff';
            this.style.color = '#2c3e50';
            this.style.webkitTextFillColor = '#2c3e50';
        });

        input.addEventListener('input', function() {
            this.style.backgroundColor = '#fff';
            this.style.color = '#2c3e50';
            this.style.webkitTextFillColor = '#2c3e50';
        });
    });

    // Ensure form labels are visible
    const formLabels = document.querySelectorAll('.subscription-form .form-label, .comment-form .form-label');
    formLabels.forEach(function(label) {
        label.style.color = '#2c3e50';
        label.style.fontWeight = '600';
        label.style.display = 'block';
    });

    // Modal Subscription Form Handler
    const modalSubscriptionForm = document.getElementById('modalSubscriptionForm');
    const modalSubscribeBtn = document.getElementById('modalSubscribeBtn');
    const modalSubscriptionMessage = document.getElementById('modalSubscriptionMessage');

    if (modalSubscriptionForm) {
        modalSubscriptionForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const email = formData.get('email');

            // Reset previous states
            modalSubscriptionMessage.style.display = 'none';
            modalSubscribeBtn.disabled = true;
            modalSubscribeBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Subscribing...';

            // Clear previous validation errors
            document.getElementById('modal_subscription_email').classList.remove('is-invalid');
            document.getElementById('modalRecaptchaError').textContent = '';

            try {
                const response = await fetch('{{ route("blog.subscribe") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Show success message
                    modalSubscriptionMessage.className = 'alert alert-success';
                    modalSubscriptionMessage.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>
                        ${data.message}
                    `;
                    modalSubscriptionMessage.style.display = 'block';

                    // Reset form
                    modalSubscriptionForm.reset();

                    // Reset reCAPTCHA
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }

                    // Close modal after 3 seconds
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('subscriptionModal'));
                        modal.hide();
                    }, 3000);
                } else {
                    // Show error message
                    modalSubscriptionMessage.className = 'alert alert-danger';
                    modalSubscriptionMessage.innerHTML = `
                        <i class="fas fa-exclamation-circle me-2"></i>
                        ${data.message || 'An error occurred. Please try again.'}
                    `;
                    modalSubscriptionMessage.style.display = 'block';

                    // Handle validation errors
                    if (data.errors) {
                        if (data.errors.email) {
                            document.getElementById('modal_subscription_email').classList.add('is-invalid');
                            document.querySelector('#modal_subscription_email + .invalid-feedback').textContent = data.errors.email[0];
                        }
                        if (data.errors['g-recaptcha-response']) {
                            document.getElementById('modalRecaptchaError').textContent = data.errors['g-recaptcha-response'][0];
                        }
                    }
                }
            } catch (error) {
                console.error('Subscription error:', error);
                modalSubscriptionMessage.className = 'alert alert-danger';
                modalSubscriptionMessage.innerHTML = `
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Network error. Please check your connection and try again.
                `;
                modalSubscriptionMessage.style.display = 'block';
            } finally {
                // Reset button
                modalSubscribeBtn.disabled = false;
                modalSubscribeBtn.innerHTML = '<i class="fas fa-bell me-2"></i><span class="btn-text">Subscribe Now</span>';

                // Auto-hide message after 8 seconds
                setTimeout(() => {
                    if (modalSubscriptionMessage.style.display !== 'none') {
                        modalSubscriptionMessage.style.display = 'none';
                    }
                }, 8000);
            }
        });
    }

    // Reset modals when they're closed
    document.getElementById('commentModal').addEventListener('hidden.bs.modal', function() {
        // Reset form
        const form = this.querySelector('form');
        if (form) form.reset();

        // Reset button
        if (modalSubmitBtn) {
            modalSubmitBtn.disabled = false;
            modalSubmitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Post Comment';
        }

        // Reset character count
        const charCount = document.getElementById('modalCharCount');
        if (charCount) charCount.textContent = '0/1000';
    });

    document.getElementById('subscriptionModal').addEventListener('hidden.bs.modal', function() {
        // Reset form
        const form = this.querySelector('form');
        if (form) form.reset();

        // Reset button
        if (modalSubscribeBtn) {
            modalSubscribeBtn.disabled = false;
            modalSubscribeBtn.innerHTML = '<i class="fas fa-bell me-2"></i><span class="btn-text">Subscribe Now</span>';
        }

        // Hide messages
        if (modalSubscriptionMessage) {
            modalSubscriptionMessage.style.display = 'none';
        }

        // Reset validation errors
        document.getElementById('modal_subscription_email').classList.remove('is-invalid');
        document.getElementById('modalRecaptchaError').textContent = '';
    });
});
</script>
@endpush
