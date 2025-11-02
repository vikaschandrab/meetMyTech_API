<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs - MeetMyTech</title>
    <meta name="description" content="Explore all blogs from tech professionals on MeetMyTech. Discover insights, tutorials, and knowledge from our community of developers and tech experts.">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('meetmytech_favicon.jpg') }}" type="image/jpeg">
    <link rel="shortcut icon" href="{{ asset('meetmytech_favicon.jpg') }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 120px 0 80px;
        }

        .blog-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .blog-image {
            height: 200px;
            object-fit: cover;
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        }

        .sidebar {
            background: #f8fafc;
            border-radius: 15px;
            padding: 30px;
        }

        .filter-section {
            margin-bottom: 30px;
        }

        .tag-filter {
            margin: 3px;
            padding: 8px 15px;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 20px;
            text-decoration: none;
            color: #374151;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .tag-filter:hover,
        .tag-filter.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .search-box {
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 12px 20px;
        }

        .search-box:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .sort-dropdown {
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 8px 15px;
        }

        .pagination .page-link {
            border-radius: 10px;
            margin: 0 3px;
            border: none;
            color: var(--primary-color);
        }

        .pagination .page-link:hover {
            background: var(--primary-color);
            color: white;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('meetmytech_logo.jpg') }}" alt="MeetMyTech" style="height: 32px; width: auto; margin-right: 8px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home.all-blogs') }}">All Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.mock-interview') }}">Mock Interview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary px-3 ms-2" href="{{ route('login') }}">Get Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-4">Explore All Blogs</h1>
                    <p class="lead">
                        Discover insights, tutorials, and knowledge from our community of {{ number_format($blogs->total()) }} published articles
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="sidebar">
                        <!-- Search -->
                        <div class="filter-section">
                            <h5 class="mb-3">
                                <i class="fas fa-search me-2 text-primary"></i>Search
                            </h5>
                            <form method="GET" action="{{ route('home.all-blogs') }}">
                                <div class="input-group">
                                    <input type="text"
                                           name="search"
                                           class="form-control search-box"
                                           placeholder="Search blogs..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <!-- Preserve other filters -->
                                @if(request('tag'))
                                    <input type="hidden" name="tag" value="{{ request('tag') }}">
                                @endif
                                @if(request('sort'))
                                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                                @endif
                            </form>
                        </div>

                        <!-- Sort Options -->
                        <div class="filter-section">
                            <h5 class="mb-3">
                                <i class="fas fa-sort me-2 text-primary"></i>Sort By
                            </h5>
                            <form method="GET" action="{{ route('home.all-blogs') }}">
                                <select name="sort" class="form-select sort-dropdown" onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                                    <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                                </select>
                                <!-- Preserve other filters -->
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                @if(request('tag'))
                                    <input type="hidden" name="tag" value="{{ request('tag') }}">
                                @endif
                            </form>
                        </div>

                        <!-- Popular Tags -->
                        @if(count($popularTags) > 0)
                        <div class="filter-section">
                            <h5 class="mb-3">
                                <i class="fas fa-tags me-2 text-primary"></i>Popular Tags
                            </h5>
                            <div class="mb-3">
                                <a href="{{ route('home.all-blogs', array_merge(request()->except('tag'), [])) }}"
                                   class="tag-filter {{ !request('tag') ? 'active' : '' }}">
                                    All Topics
                                </a>
                            </div>
                            @foreach($popularTags as $tag => $count)
                                <a href="{{ route('home.all-blogs', array_merge(request()->except('tag'), ['tag' => $tag])) }}"
                                   class="tag-filter {{ request('tag') == $tag ? 'active' : '' }}">
                                    {{ $tag }} ({{ $count }})
                                </a>
                            @endforeach
                        </div>
                        @endif

                        <!-- Quick Stats -->
                        <div class="filter-section">
                            <h5 class="mb-3">
                                <i class="fas fa-chart-bar me-2 text-primary"></i>Stats
                            </h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-newspaper text-muted me-2"></i>
                                    {{ number_format($blogs->total()) }} Total Blogs
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-eye text-muted me-2"></i>
                                    {{ number_format(\App\Models\Blog::sum('views_count')) }} Total Views
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Blog Grid -->
                <div class="col-lg-9">
                    <!-- Current Filters Display -->
                    @if(request('search') || request('tag') || request('sort', 'latest') != 'latest')
                    <div class="mb-4">
                        <h6 class="text-muted">
                            Active Filters:
                            @if(request('search'))
                                <span class="badge bg-primary me-2">
                                    Search: "{{ request('search') }}"
                                    <a href="{{ route('home.all-blogs', array_merge(request()->except('search'), [])) }}" class="text-white ms-1">×</a>
                                </span>
                            @endif
                            @if(request('tag'))
                                <span class="badge bg-success me-2">
                                    Tag: {{ request('tag') }}
                                    <a href="{{ route('home.all-blogs', array_merge(request()->except('tag'), [])) }}" class="text-white ms-1">×</a>
                                </span>
                            @endif
                            @if(request('sort', 'latest') != 'latest')
                                <span class="badge bg-info me-2">
                                    Sort: {{ ucfirst(request('sort')) }}
                                    <a href="{{ route('home.all-blogs', array_merge(request()->except('sort'), [])) }}" class="text-white ms-1">×</a>
                                </span>
                            @endif
                            <a href="{{ route('home.all-blogs') }}" class="btn btn-outline-secondary btn-sm ms-2">Clear All</a>
                        </h6>
                    </div>
                    @endif

                    <!-- Results Info -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">
                            @if($blogs->total() > 0)
                                Showing {{ $blogs->firstItem() }}-{{ $blogs->lastItem() }} of {{ number_format($blogs->total()) }} blogs
                            @else
                                No blogs found
                            @endif
                        </h5>
                    </div>

                    <!-- Blog Cards -->
                    @if($blogs->count() > 0)
                        <div class="row g-4">
                            @foreach($blogs as $blog)
                            <div class="col-lg-6 col-md-6">
                                <div class="card blog-card">
                                    @if($blog->featured_image)
                                        <img src="{{ asset('storage/'.$blog->featured_image) }}" class="card-img-top blog-image" alt="{{ $blog->title }}">
                                    @else
                                        <div class="blog-image d-flex align-items-center justify-content-center">
                                            <i class="fas fa-laptop-code text-white" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex align-items-center mb-3">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $blog->published_at->format('M d, Y') }}
                                            </small>
                                            @if($blog->is_featured)
                                                <span class="badge bg-warning text-dark ms-auto">Featured</span>
                                            @endif
                                        </div>

                                        <h5 class="card-title mb-3">
                                            <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                                {{ $blog->title }}
                                            </a>
                                        </h5>

                                        <p class="card-text text-muted flex-grow-1">
                                            {{ Str::limit($blog->description, 120) }}
                                        </p>

                                        <!-- Tags -->
                                        @if($blog->tags && is_array($blog->tags) && count($blog->tags) > 0)
                                        <div class="mb-3">
                                            @foreach(array_slice($blog->tags, 0, 2) as $tag)
                                                <span class="badge bg-light text-dark me-1">#{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                        @endif

                                        <div class="d-flex align-items-center justify-content-between mt-auto">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-circle text-muted me-2"></i>
                                                <small class="text-muted">
                                                    <a href="{{ \App\Helpers\UrlHelper::profileSubdomain($blog->user->slug) }}" class="text-decoration-none text-muted" target="_blank">
                                                        {{ $blog->user->name }}
                                                    </a>
                                                </small>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                @if($blog->views_count)
                                                <small class="text-muted">
                                                    <i class="fas fa-eye me-1"></i>{{ $blog->views_count }}
                                                </small>
                                                @endif
                                                <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-outline-primary btn-sm">
                                                    Read More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-5">
                            {{ $blogs->withQueryString()->links() }}
                        </div>
                    @else
                        <!-- No Results -->
                        <div class="text-center py-5">
                            <i class="fas fa-search text-muted mb-3" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mb-3">No blogs found</h4>
                            <p class="text-muted mb-4">
                                @if(request('search') || request('tag'))
                                    Try adjusting your search criteria or browse all blogs.
                                @else
                                    Be the first to share your knowledge with the community!
                                @endif
                            </p>
                            @if(request('search') || request('tag'))
                                <a href="{{ route('home.all-blogs') }}" class="btn btn-primary me-3">View All Blogs</a>
                            @endif
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Start Writing</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

   @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
