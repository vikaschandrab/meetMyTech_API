@extends('Users.Layouts.app')

@section('title', $blog->title . ' | ' . Auth::user()->name)

@push('meta')
<meta name="description" content="{{ $blog->meta_description ?? Str::limit($blog->description, 160) }}">
<meta name="keywords" content="{{ $blog->meta_keywords ?? implode(',', $blog->tags ?? []) }}">

{{-- Open Graph meta tags --}}
<meta property="og:title" content="{{ $blog->title }}">
<meta property="og:description" content="{{ $blog->meta_description ?? Str::limit($blog->description, 160) }}">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ url()->current() }}">
@if($blog->featured_image)
<meta property="og:image" content="{{ asset('storage/' . $blog->featured_image) }}">
@endif

{{-- Twitter Card meta tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $blog->title }}">
<meta name="twitter:description" content="{{ $blog->meta_description ?? Str::limit($blog->description, 160) }}">
@if($blog->featured_image)
<meta name="twitter:image" content="{{ asset('storage/' . $blog->featured_image) }}">
@endif
@endpush

@push('styles')
<style>
    .blog-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
    }
    
    .blog-meta {
        background: rgba(255,255,255,0.1);
        border-radius: 0.5rem;
        padding: 1rem;
        margin-top: 1rem;
    }
    
    .blog-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #495057;
    }
    
    .blog-content h1,
    .blog-content h2,
    .blog-content h3,
    .blog-content h4,
    .blog-content h5,
    .blog-content h6 {
        color: #2c3e50;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .blog-content p {
        margin-bottom: 1.5rem;
    }
    
    .blog-content blockquote {
        border-left: 4px solid #007bff;
        padding-left: 1rem;
        margin: 2rem 0;
        font-style: italic;
        background: #f8f9fa;
        padding: 1rem 1rem 1rem 2rem;
        border-radius: 0.25rem;
    }
    
    .blog-content code {
        background: #f8f9fa;
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        font-size: 0.9em;
        color: #e83e8c;
    }
    
    .blog-content pre {
        background: #2d3748;
        color: #f7fafc;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1.5rem 0;
    }
    
    .blog-content pre code {
        background: none;
        color: inherit;
        padding: 0;
    }
    
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1rem 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .blog-tags {
        margin: 2rem 0;
    }
    
    .tag-item {
        background: #e9ecef;
        color: #495057;
        padding: 0.375rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.875rem;
        text-decoration: none;
        margin: 0.25rem;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .tag-item:hover {
        background: #007bff;
        color: white;
        text-decoration: none;
    }
    
    .featured-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    .blog-actions {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin: 2rem 0;
        text-align: center;
    }
    
    .reading-time {
        background: rgba(255,255,255,0.1);
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-size: 0.875rem;
        display: inline-block;
    }
    
    .blog-status {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-left: 1rem;
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
    
    .blog-sidebar {
        position: sticky;
        top: 2rem;
    }
    
    .table-of-contents {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .table-of-contents ul {
        list-style: none;
        padding-left: 0;
    }
    
    .table-of-contents ul ul {
        padding-left: 1rem;
        margin-top: 0.5rem;
    }
    
    .table-of-contents a {
        color: #495057;
        text-decoration: none;
        padding: 0.25rem 0;
        display: block;
        border-radius: 0.25rem;
        padding-left: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .table-of-contents a:hover,
    .table-of-contents a.active {
        background: #007bff;
        color: white;
    }
    
    .blog-navigation {
        border-top: 1px solid #dee2e6;
        padding-top: 2rem;
        margin-top: 3rem;
    }
    
    .nav-blog {
        padding: 1rem;
        border-radius: 0.5rem;
        background: #f8f9fa;
        text-decoration: none;
        color: #495057;
        transition: all 0.3s ease;
    }
    
    .nav-blog:hover {
        background: #e9ecef;
        color: #007bff;
        text-decoration: none;
    }
    
    .blog-share {
        position: fixed;
        left: 2rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .share-btn {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: white;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }
    
    .share-facebook { background: #3b5998; }
    .share-twitter { background: #1da1f2; }
    .share-linkedin { background: #0077b5; }
    .share-copy { background: #6c757d; }
    
    .share-btn:hover {
        transform: scale(1.1);
        color: white;
        text-decoration: none;
    }
    
    @media (max-width: 768px) {
        .blog-share {
            position: static;
            transform: none;
            flex-direction: row;
            justify-content: center;
            margin: 2rem 0;
        }
        
        .blog-header {
            padding: 2rem 0;
        }
        
        .featured-image {
            height: 200px;
        }
    }
    
    .print-only {
        display: none;
    }
    
    @media print {
        .blog-actions,
        .blog-navigation,
        .blog-share,
        .no-print {
            display: none !important;
        }
        
        .print-only {
            display: block;
        }
        
        .blog-content {
            font-size: 12pt;
            line-height: 1.6;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    {{-- Blog Share Buttons --}}
    <div class="blog-share no-print">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
           target="_blank" 
           class="share-btn share-facebook"
           title="Share on Facebook">
            <i data-feather="facebook"></i>
        </a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}" 
           target="_blank" 
           class="share-btn share-twitter"
           title="Share on Twitter">
            <i data-feather="twitter"></i>
        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
           target="_blank" 
           class="share-btn share-linkedin"
           title="Share on LinkedIn">
            <i data-feather="linkedin"></i>
        </a>
        <a href="#" 
           class="share-btn share-copy" 
           id="copyLink"
           title="Copy Link">
            <i data-feather="copy"></i>
        </a>
    </div>

    {{-- Blog Header --}}
    <div class="blog-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-3">{{ $blog->title }}</h1>
                    
                    @if($blog->description)
                        <p class="lead mb-4">{{ $blog->description }}</p>
                    @endif
                    
                    <div class="blog-meta">
                        <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center">
                                <i data-feather="calendar" class="feather-sm me-2"></i>
                                {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i data-feather="clock" class="feather-sm me-2"></i>
                                <span class="reading-time">{{ $estimatedReadTime ?? '5' }} min read</span>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i data-feather="eye" class="feather-sm me-2"></i>
                                {{ $blog->views_count ?? 0 }} views
                            </div>
                            
                            <span class="blog-status status-{{ $blog->status }}">
                                {{ ucfirst($blog->status) }}
                            </span>
                            
                            @if($blog->is_featured)
                                <span class="badge bg-warning">
                                    <i data-feather="star" class="feather-sm me-1"></i>
                                    Featured
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Action Buttons for Author --}}
                <div class="blog-actions no-print mb-4">
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="{{ route('blogs.edit', $blog->slug) }}" class="btn btn-primary">
                            <i data-feather="edit" class="feather-sm me-1"></i>
                            Edit Blog
                        </a>
                        <a href="{{ route('blogs.duplicate', $blog->slug) }}" class="btn btn-outline-secondary">
                            <i data-feather="copy" class="feather-sm me-1"></i>
                            Duplicate
                        </a>
                        <button class="btn btn-outline-info" onclick="window.print()">
                            <i data-feather="printer" class="feather-sm me-1"></i>
                            Print
                        </button>
                        <form action="{{ route('blogs.destroy', $blog->slug) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i data-feather="trash-2" class="feather-sm me-1"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Featured Image --}}
                @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                         alt="{{ $blog->title }}" 
                         class="featured-image">
                @endif

                {{-- Print Header --}}
                <div class="print-only">
                    <h1>{{ $blog->title }}</h1>
                    <p><strong>By:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Published:</strong> {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</p>
                    <hr>
                </div>

                {{-- Blog Content --}}
                <div class="blog-content">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                {{-- Tags --}}
                @if($blog->tags && count($blog->tags) > 0)
                    <div class="blog-tags">
                        <h5 class="mb-3">Tags:</h5>
                        @foreach($blog->tags as $tag)
                            <a href="{{ route('blogs.index', ['search' => $tag]) }}" class="tag-item">
                                {{ $tag }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Navigation to Other Blogs --}}
                <div class="blog-navigation no-print">
                    <div class="row">
                        @if(isset($previousBlog))
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('blogs.show', $previousBlog->slug) }}" class="nav-blog">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="chevron-left" class="feather-sm me-2"></i>
                                        <div>
                                            <small class="text-muted">Previous Post</small>
                                            <h6 class="mb-0">{{ Str::limit($previousBlog->title, 50) }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        
                        @if(isset($nextBlog))
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('blogs.show', $nextBlog->slug) }}" class="nav-blog">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <small class="text-muted">Next Post</small>
                                            <h6 class="mb-0">{{ Str::limit($nextBlog->title, 50) }}</h6>
                                        </div>
                                        <i data-feather="chevron-right" class="feather-sm ms-2"></i>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="blog-sidebar no-print">
                    {{-- Table of Contents --}}
                    <div class="table-of-contents">
                        <h5 class="mb-3">
                            <i data-feather="list" class="feather-sm me-2"></i>
                            Table of Contents
                        </h5>
                        <div id="tableOfContents">
                            <p class="text-muted">No headings found in content</p>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Quick Actions</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i data-feather="arrow-left" class="feather-sm me-1"></i>
                                    Back to Blogs
                                </a>
                                <a href="{{ route('blogs.create') }}" class="btn btn-outline-success btn-sm">
                                    <i data-feather="plus" class="feather-sm me-1"></i>
                                    Create New Blog
                                </a>
                                <button class="btn btn-outline-info btn-sm" id="toggleDarkMode">
                                    <i data-feather="moon" class="feather-sm me-1"></i>
                                    Dark Mode
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Blog Stats --}}
                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Blog Statistics</h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h4 class="mb-0 text-primary">{{ $blog->views_count ?? 0 }}</h4>
                                    <small class="text-muted">Views</small>
                                </div>
                                <div class="col-6">
                                    <h4 class="mb-0 text-success">{{ str_word_count($blog->content) }}</h4>
                                    <small class="text-muted">Words</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Related Blogs --}}
                    @if(isset($relatedBlogs) && count($relatedBlogs) > 0)
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Related Blogs</h6>
                            </div>
                            <div class="card-body">
                                @foreach($relatedBlogs as $related)
                                    <div class="mb-3">
                                        <a href="{{ route('blogs.show', $related->slug) }}" class="text-decoration-none">
                                            <h6 class="mb-1">{{ Str::limit($related->title, 40) }}</h6>
                                        </a>
                                        <small class="text-muted">
                                            {{ $related->published_at ? $related->published_at->format('M d, Y') : $related->created_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generate Table of Contents
    function generateTableOfContents() {
        const content = document.querySelector('.blog-content');
        const tocContainer = document.getElementById('tableOfContents');
        const headings = content.querySelectorAll('h1, h2, h3, h4, h5, h6');
        
        if (headings.length === 0) {
            return;
        }
        
        let tocHTML = '<ul>';
        headings.forEach((heading, index) => {
            const id = `heading-${index}`;
            heading.id = id;
            
            const level = parseInt(heading.tagName.charAt(1));
            const indent = level > 2 ? 'style="margin-left: ' + ((level - 2) * 1) + 'rem;"' : '';
            
            tocHTML += `<li ${indent}><a href="#${id}" class="toc-link">${heading.textContent}</a></li>`;
        });
        tocHTML += '</ul>';
        
        tocContainer.innerHTML = tocHTML;
        
        // Add smooth scrolling and active state
        const tocLinks = tocContainer.querySelectorAll('.toc-link');
        tocLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Highlight active section on scroll
        window.addEventListener('scroll', function() {
            let current = '';
            headings.forEach(heading => {
                const rect = heading.getBoundingClientRect();
                if (rect.top <= 100) {
                    current = heading.id;
                }
            });
            
            tocLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    }
    
    generateTableOfContents();
    
    // Copy link functionality
    const copyBtn = document.getElementById('copyLink');
    copyBtn.addEventListener('click', function(e) {
        e.preventDefault();
        navigator.clipboard.writeText(window.location.href).then(function() {
            // Show success message
            Swal.fire({
                title: 'Link Copied!',
                text: 'Blog link has been copied to clipboard',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        });
    });
    
    // Dark mode toggle
    const darkModeBtn = document.getElementById('toggleDarkMode');
    const body = document.body;
    
    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
        darkModeBtn.innerHTML = '<i data-feather="sun" class="feather-sm me-1"></i>Light Mode';
    }
    
    darkModeBtn.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('darkMode', 'enabled');
            this.innerHTML = '<i data-feather="sun" class="feather-sm me-1"></i>Light Mode';
        } else {
            localStorage.setItem('darkMode', null);
            this.innerHTML = '<i data-feather="moon" class="feather-sm me-1"></i>Dark Mode';
        }
        
        // Re-initialize feather icons
        feather.replace();
    });
    
    // Delete confirmation
    const deleteForm = document.querySelector('.delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
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
                    this.submit();
                }
            });
        });
    }
    
    // Reading progress indicator
    function updateReadingProgress() {
        const content = document.querySelector('.blog-content');
        const windowHeight = window.innerHeight;
        const documentHeight = content.offsetHeight;
        const scrollTop = window.pageYOffset;
        const contentTop = content.offsetTop;
        
        const progress = Math.max(0, Math.min(100, 
            ((scrollTop - contentTop + windowHeight) / documentHeight) * 100
        ));
        
        // You can add a progress bar here if needed
        console.log('Reading progress:', progress + '%');
    }
    
    window.addEventListener('scroll', updateReadingProgress);
    
    // Enhance content formatting
    function enhanceContent() {
        const content = document.querySelector('.blog-content');
        
        // Convert markdown-like formatting to HTML
        let html = content.innerHTML;
        
        // Bold text **text**
        html = html.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        
        // Italic text *text*
        html = html.replace(/\*(.*?)\*/g, '<em>$1</em>');
        
        // Inline code `code`
        html = html.replace(/`(.*?)`/g, '<code>$1</code>');
        
        // Links [text](url)
        html = html.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank">$1</a>');
        
        content.innerHTML = html;
    }
    
    enhanceContent();
});

// Add dark mode styles
const darkModeStyles = `
    .dark-mode {
        background-color: #1a1a1a;
        color: #e0e0e0;
    }
    
    .dark-mode .blog-content {
        color: #e0e0e0;
    }
    
    .dark-mode .blog-content h1,
    .dark-mode .blog-content h2,
    .dark-mode .blog-content h3,
    .dark-mode .blog-content h4,
    .dark-mode .blog-content h5,
    .dark-mode .blog-content h6 {
        color: #ffffff;
    }
    
    .dark-mode .card {
        background-color: #2d2d2d;
        border-color: #444;
    }
    
    .dark-mode .table-of-contents {
        background-color: #2d2d2d;
    }
    
    .dark-mode .tag-item {
        background-color: #444;
        color: #e0e0e0;
    }
`;

// Inject dark mode styles
const styleSheet = document.createElement('style');
styleSheet.textContent = darkModeStyles;
document.head.appendChild(styleSheet);
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
