<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- Basic Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <meta name="description" content="@yield('meta_description', __('Professional portfolio of Vikas Chandra - Skilled PHP developer with expertise in crafting dynamic and efficient web applications using Laravel, Symfony, CodeIgniter, and modern technologies.'))">
    <meta name="keywords" content="@yield('meta_keywords', 'Vikas Chandra, PHP developer, Web development, Laravel, Symfony, CodeIgniter, MySQL, JavaScript, Full-stack developer, Software engineer')">
    <meta name="author" content="@yield('meta_author', 'B Vikas Chandra')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', request()->url())">
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', __('Professional portfolio of Vikas Chandra'))">
    <meta property="og:image" content="@yield('og_image', asset('vikas_css/images/my_image.png'))">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:url" content="@yield('twitter_url', request()->url())">
    <meta name="twitter:title" content="@yield('twitter_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('twitter_description', __('Professional portfolio of Vikas Chandra'))">
    <meta name="twitter:image" content="@yield('twitter_image', asset('vikas_css/images/my_image.png'))">

    {{-- Favicon and Touch Icons --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('vikas_css/images/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vikas_css/images/my-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vikas_css/images/my-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('vikas_css/images/my-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('vikas_css/images/my-icon-114x114.png') }}">

    {{-- Preconnect for external resources --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Stylesheets --}}
    @stack('preload-styles')

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap"
          rel="stylesheet">

    {{-- Core CSS --}}
    <link rel="stylesheet" href="{{ asset('vikas_css/icons/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/jquery.fancybox.min.css') }}">

    {{-- Custom Styles --}}
    <link rel="stylesheet" href="{{ asset('vikas_css/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('vikas_css/css/responsive.css') }}">

    {{-- Theme Colors --}}
    @php
        $theme = session('theme', 'default');
    @endphp

    @if($theme !== 'default')
        <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/blue.css') }}" title="blue">
        <link rel="stylesheet" href="{{ asset('vikas_css/css/colors/' . $theme . '.css') }}" title="{{ $theme }}">
        <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/green.css') }}" title="green">
        <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/blue-munsell.css') }}" title="blue-munsell">
        <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/orange.css') }}" title="orange">
        <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/purple.css') }}" title="purple">
        <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/slate.css') }}" title="slate">
        <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/yellow.css') }}" title="yellow">
    @else
        <link rel="stylesheet" href="{{ asset('vikas_css/css/colors/defauld.css') }}" title="default">
    @endif

    {{-- Additional Styles --}}
    @stack('styles')

    {{-- Custom CSS for current page --}}
    @yield('styles')

    {{-- JSON-LD Structured Data --}}
    @hasSection('structured_data')
        @yield('structured_data')
    @else
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Person",
            "name": "B Vikas Chandra",
            "jobTitle": "Software Developer",
            "description": "Skilled PHP developer with expertise in crafting dynamic and efficient web applications",
            "url": "{{ request()->url() }}",
            "image": "{{ asset('vikas_css/images/my_image.png') }}",
            "sameAs": [
                "https://www.linkedin.com/in/vikas-chandra-258a48118/",
                "https://www.facebook.com/vikas.chandra.39",
                "https://www.instagram.com/vickey_vikas/"
            ],
            "knowsAbout": ["PHP", "Laravel", "Symfony", "CodeIgniter", "MySQL", "JavaScript", "Web Development"],
            "email": "chandravikasa38@gmail.com",
            "telephone": "+91-7411247463"
        }
        </script>
    @endif
</head>

<body class="@yield('body_class', 'dark-vertion black-bg')" @yield('body_attributes')>
    {{-- Skip to content link for accessibility --}}
    <a href="#main-content" class="skip-link visually-hidden-focusable">{{ __('Skip to main content') }}</a>

    <main id="main-content">
        @yield('content')
    </main>

    {{-- Core JavaScript --}}
    @include('Vikas.partials.scripts')

    {{-- Additional Scripts --}}
    @stack('scripts')

    {{-- Page-specific Scripts --}}
    @yield('scripts')
</body>
</html>

{{-- CSS for accessibility --}}
@push('styles')
<style>
.skip-link {
    position: absolute;
    top: -40px;
    left: 6px;
    background: #000;
    color: #fff;
    padding: 8px;
    text-decoration: none;
    z-index: 9999;
}

.skip-link:focus {
    top: 6px;
}

.visually-hidden-focusable:not(:focus):not(:focus-within) {
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
</style>
@endpush
