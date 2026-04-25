<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <!-- Homepage -->
    <url>
        <loc>{{ config('app.url') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- All Blogs Page -->
    <url>
        <loc>{{ route('home.all-blogs') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    <!-- Contact Page -->
    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    <!-- Mock Interview Page -->
    <url>
        <loc>{{ route('home.mock-interview') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Individual Blog Posts -->
    @foreach($blogs as $blog)
    <url>
        <loc>{{ route('blogs.show', $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>{{ $blog->is_featured ? '0.9' : '0.8' }}</priority>
    </url>
    @endforeach

    <!-- User Profile Pages -->
    @foreach($users as $user)
    <url>
        <loc>{{ url('https://' . str_replace(' ', '', strtolower($user->name)) . '.' . config('app.domain')) }}</loc>
        <lastmod>{{ $user->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

</urlset>
