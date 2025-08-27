<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @php
    use Illuminate\Support\Str;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>{{ $UserDetails->name }} - Personal CV/Resume</title>
    @if($UserDetails->seo_description)
    <meta name="description" content="{{ $UserDetails->seo_description }}">
    @endif
    @if($UserDetails->seo_keywords)
    <meta name="keywords" content="{{ $UserDetails->seo_keywords }}">
    @endif
    <meta name="author" content="{{ $UserDetails->name }}">
    <meta name="robots" content="index, follow">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="{{ $UserDetails->name }} - Personal CV/Resume">
    @if ($UserDetails->seo_description)
    <meta property="og:description" content="{{ $UserDetails->seo_description }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($UserDetails->profilePic)
    <meta property="og:image" content="{{ asset('storage/'.$UserDetails->profilePic) }}">
    @endif

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $UserDetails->name }} - Personal CV/Resume">
    <meta name="twitter:description" content="Skilled PHP developer with 7+ years of experience in web development">
    @if($UserDetails->profilePic)
    <meta name="twitter:image" content="{{ asset('storage/'.$UserDetails->profilePic) }}">
    @endif

    {{-- Favicons --}}
    @if($UserDetails->logo_16_14_ico && $UserDetails->logo_16_14_png && $UserDetails->logo_72_72_png && $UserDetails->logo_114_114_png)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/'.$UserDetails->logo_16_14_ico) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/'.$UserDetails->logo_16_14_png) }}">
    <link rel="icon" type="image/png" sizes="72x72" href="{{ asset('storage/'.$UserDetails->logo_72_72_png) }}">
    <link rel="icon" type="image/png" sizes="114x114" href="{{ asset('storage/'.$UserDetails->logo_114_114_png) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/'.$UserDetails->logo_114_114_png) }}">
    @endif

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- External Stylesheets --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    {{-- Stylesheets --}}
    @push('styles')
        <link rel="stylesheet" href="{{ asset('vikas_css/icons/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/owl.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/css/blog-section.css') }}">
    @endpush

    {{-- Color Themes --}}
    @stack('color-themes')
    <link rel="stylesheet" href="{{ asset('vikas_css/css/colors/defauld.css') }}" title="default">
    <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/blue.css') }}" title="blue">
    <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/green.css') }}" title="green">
    <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/blue-munsell.css') }}" title="blue-munsell">
    <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/orange.css') }}" title="orange">
    <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/purple.css') }}" title="purple">
    <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/slate.css') }}" title="slate">
    <link rel="alternate stylesheet" href="{{ asset('vikas_css/css/colors/yellow.css') }}" title="yellow">

    @stack('styles')

    {{-- Modern Minimalist Design --}}
    <style>
        /* Clean Modern Background */
        body {
            background: #fafbfc !important;
            background-image:
                radial-gradient(circle at 50% 50%, rgba(74, 144, 226, 0.03) 0%, transparent 50%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.8) 0%, rgba(248, 250, 252, 0.9) 100%);
            font-family: 'Inter', 'Roboto', sans-serif !important;
            line-height: 1.6;
        }

        /* Geometric floating elements */
        body::after {
            content: '';
            position: fixed;
            top: 10%;
            right: 5%;
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
            border-radius: 50%;
            animation: floatRight 15s ease-in-out infinite;
            z-index: -1;
        }

        body::before {
            content: '';
            position: fixed;
            bottom: 10%;
            left: 5%;
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, rgba(34, 197, 94, 0.1), rgba(59, 130, 246, 0.1));
            border-radius: 30%;
            animation: floatLeft 20s ease-in-out infinite reverse;
            z-index: -1;
        }

        @keyframes floatRight {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-30px) scale(1.1); }
        }

        @keyframes floatLeft {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Modern Section Styling */
        section {
            background: transparent !important;
            padding: 80px 0;
            position: relative;
        }

        /* Modern Hero Section */
        .mh-home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            min-height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            position: relative !important;
            overflow: hidden !important;
            padding: 0 !important;
        }

        .mh-home::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.9) 100%);
            animation: gradientShift 8s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }

        .mh-home .container {
            position: relative !important;
            z-index: 2 !important;
        }

        .mh-home * {
            color: white !important;
            position: relative !important;
            z-index: 2 !important;
        }

        /* Hero Content Styling */
        .mh-header-info {
            padding: 40px 0 !important;
        }

        .mh-promo span {
            font-size: 1.2rem !important;
            font-weight: 400 !important;
            color: rgba(255, 255, 255, 0.9) !important;
            display: block !important;
            margin-bottom: 10px !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
        }

        .mh-home h2 {
            font-size: 4rem !important;
            font-weight: 800 !important;
            line-height: 1.1 !important;
            margin: 20px 0 !important;
            color: white !important;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3) !important;
        }

        .mh-home h4 {
            font-size: 1.5rem !important;
            font-weight: 400 !important;
            color: rgba(255, 255, 255, 0.9) !important;
            margin-bottom: 30px !important;
            line-height: 1.4 !important;
        }

        /* Contact Info List */
        .mh-header-info ul:not(.social-icon) {
            list-style: none !important;
            padding: 0 !important;
            margin: 30px 0 !important;
        }

        .mh-header-info ul:not(.social-icon) li {
            display: flex !important;
            align-items: center !important;
            margin-bottom: 15px !important;
            font-size: 1.1rem !important;
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .mh-header-info ul:not(.social-icon) li i {
            width: 20px !important;
            margin-right: 15px !important;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .mh-header-info ul:not(.social-icon) li a {
            color: white !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
        }

        .mh-header-info ul:not(.social-icon) li a:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Social Icons */
        .social-icon {
            display: flex !important;
            gap: 15px !important;
            margin-top: 40px !important;
            padding: 0 !important;
            list-style: none !important;
        }

        .social-icon li a {
            width: 50px !important;
            height: 50px !important;
            border-radius: 50% !important;
            background: rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 1.2rem !important;
            transition: all 0.3s ease !important;
            backdrop-filter: blur(10px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .social-icon li a:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            transform: translateY(-3px) scale(1.1) !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2) !important;
        }

        /* Hero Image Styling */
        .hero-img {
            text-align: center !important;
            position: relative !important;
        }

        .hero-img .img-border {
            position: relative !important;
            display: inline-block !important;
        }

        .hero-img .img-border::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
            border-radius: 50% !important;
            animation: pulse 3s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.05); opacity: 0.3; }
        }

        .hero-img img {
            width: 350px !important;
            height: 350px !important;
            object-fit: cover !important;
            border-radius: 50% !important;
            border: 6px solid rgba(255, 255, 255, 0.3) !important;
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 10px 20px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.4s ease !important;
        }

        .hero-img:hover img {
            transform: scale(1.05) !important;
            box-shadow:
                0 30px 60px rgba(0, 0, 0, 0.4),
                0 15px 30px rgba(0, 0, 0, 0.3) !important;
        }

        /* Floating Animation for Hero Elements */
        .hero-floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .hero-floating-element:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .hero-floating-element:nth-child(2) {
            width: 40px;
            height: 40px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .hero-floating-element:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Responsive Design for Hero */
        @media (max-width: 768px) {
            .mh-home {
                min-height: 100vh !important;
                text-align: center !important;
            }

            .mh-home h2 {
                font-size: 2.5rem !important;
            }

            .mh-home h4 {
                font-size: 1.2rem !important;
            }

            .hero-img img {
                width: 250px !important;
                height: 250px !important;
            }

            .mh-header-info {
                padding: 20px 0 !important;
            }

            .social-icon {
                justify-content: center !important;
            }
        }        .mh-about {
            background: #ffffff !important;
        }

        .mh-service {
            background: #f8fafc !important;
        }

        .mh-skills {
            background: #ffffff !important;
        }

        .mh-experince {
            background: #f1f5f9 !important;
        }

        .mh-blogs {
            background: #ffffff !important;
        }

        .mh-contact {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%) !important;
            color: white !important;
        }

        .mh-contact * {
            color: white !important;
        }

        /* Modern Card Design */
        .mh-service-item,
        .mh-education-item,
        .mh-work-item,
        .mh-blog-item,
        .mh-address-footer-item {
            background: white !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 16px !important;
            padding: 32px 24px !important;
            box-shadow:
                0 1px 3px 0 rgba(0, 0, 0, 0.1),
                0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .mh-service-item::before,
        .mh-education-item::before,
        .mh-work-item::before,
        .mh-blog-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #06b6d4);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .mh-service-item:hover::before,
        .mh-education-item:hover::before,
        .mh-work-item:hover::before,
        .mh-blog-item:hover::before {
            transform: scaleX(1);
        }

        .mh-service-item:hover,
        .mh-education-item:hover,
        .mh-work-item:hover,
        .mh-blog-item:hover,
        .mh-address-footer-item:hover {
            transform: translateY(-4px);
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
            border-color: #c7d2fe !important;
        }

        /* Modern Typography */
        h1, h2, h3, h4, h5, h6 {
            color: #1e293b !important;
            font-weight: 700 !important;
            letter-spacing: -0.025em;
            line-height: 1.2;
        }

        .section-title h2,
        .section-title h3 {
            color: #1e293b !important;
            position: relative;
            font-size: 2.5rem !important;
            font-weight: 800 !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .section-title h2::after,
        .section-title h3::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        p, span, li {
            color: #64748b !important;
            font-weight: 400 !important;
            line-height: 1.7;
        }

        /* Modern Header */
        .mh-header {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8) !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link {
            color: #334155 !important;
            font-weight: 500 !important;
            font-size: 0.95rem;
            padding: 12px 20px !important;
            margin: 0 4px;
            border-radius: 8px;
            transition: all 0.2s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: #3b82f6 !important;
            background: #f1f5f9 !important;
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link.active {
            color: #3b82f6 !important;
            background: #eff6ff !important;
        }

        /* Modern Buttons and Links */
        a {
            color: #3b82f6 !important;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        a:hover {
            color: #1d4ed8 !important;
        }

        /* Social Icons */
        .social-icon li a {
            width: 48px !important;
            height: 48px !important;
            border-radius: 12px !important;
            background: white !important;
            color: #64748b !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1) !important;
            transition: all 0.3s ease !important;
            border: 1px solid #e2e8f0 !important;
        }

        .social-icon li a:hover {
            background: #3b82f6 !important;
            color: white !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px 0 rgba(59, 130, 246, 0.4) !important;
        }

        /* Skills Section */
        .mh-progress {
            background: white !important;
            border-radius: 12px !important;
            padding: 24px !important;
            margin: 16px 0 !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #e2e8f0 !important;
            color: #334155 !important;
        }

        /* Contact Form */
        .form-control {
            border: 1px solid #d1d5db !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
            font-size: 1rem !important;
            transition: all 0.2s ease !important;
            background: white !important;
        }

        .form-control:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
            outline: none !important;
        }

        /* Profile Image */
        .home-photo img {
            border-radius: 20px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.3s ease !important;
        }

        .home-photo:hover img {
            transform: scale(1.02) !important;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3) !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section-title h2,
            .section-title h3 {
                font-size: 2rem !important;
            }

            .mh-service-item,
            .mh-education-item,
            .mh-work-item,
            .mh-blog-item {
                margin-bottom: 24px !important;
                padding: 24px 20px !important;
            }

            body::after,
            body::before {
                display: none;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
    <body class="white-version" data-spy="scroll" data-target="#navbar" data-offset="50">
    {{-- <body class="dark-vertion black-bg" data-spy="scroll" data-target="#navbar" data-offset="50"> --}}
<main>
<!-- Start Loader -->
        <div class="section-loader">
            <div class="loader">
                <div></div>
                <div></div>
            </div>
        </div>
        <!-- End Loader -->

        <!--
        ===================
           NAVIGATION
        ===================
        -->
        <header class="mh-header mh-fixed-nav nav-scroll mh-xs-mobile-nav" id="mh-header">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg mh-nav nav-btn">
                        @if($UserDetails->logo_png)
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('storage/'.$UserDetails->logo_png) }}" alt="{{ $UserDetails->name }}" class="img-fluid" width="64px">
                        </a>
                        @endif
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-0 ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#mh-home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#mh-about">About</a>
                                </li>
                                <li class="nav-item">
                                   <a class="nav-link" href="#mh-skills">Skills</a>
                                </li>
                                <li class="nav-item">
                                   <a class="nav-link" href="#mh-experience">Experiences</a>
                                </li>
                                <li class="nav-item">
                                   <a class="nav-link" href="#mh-blogs">Blogs</a>
                                </li>
                                <li class="nav-item">
                                   <a class="nav-link" href="#mh-contact">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <!--
        ===================
           Modern Hero Home
        ===================
        -->
        <section class="mh-home" id="mh-home">
            <!-- Floating Decorative Elements -->
            <div class="hero-floating-element"></div>
            <div class="hero-floating-element"></div>
            <div class="hero-floating-element"></div>

            <div class="container">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6 col-md-12">
                        <div class="mh-header-info">
                            <div class="mh-promo wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
                                <span>👋 Hello, I'm</span>
                            </div>

                            <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                {{ $UserDetails->name }}
                            </h2>

                            <h4 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                @if($WorkExperiences && $WorkExperiences->count() > 0)
                                    {{ $WorkExperiences->first()->position }}
                                    @if($WorkExperiences->first()->to_date === null)
                                        <span style="font-size: 0.9rem; opacity: 0.8;"> — Currently Working</span>
                                    @endif
                                @else
                                    Full Stack Developer & Technology Enthusiast
                                @endif
                            </h4>

                            <div class="hero-description wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                                <p style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 30px; opacity: 0.9;">
                                    Passionate about creating innovative solutions and building amazing digital experiences.
                                    Let's bring your ideas to life with cutting-edge technology.
                                </p>
                            </div>

                            <div class="hero-contact-info wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s">
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="display: flex; align-items: center; margin-bottom: 12px;">
                                        <i class="fa fa-envelope" style="width: 20px; margin-right: 15px; opacity: 0.8;"></i>
                                        <a href="mailto:{{ $UserDetails->email }}" style="color: white; text-decoration: none;">
                                            {{ $UserDetails->email }}
                                        </a>
                                    </li>
                                    @if(isset($UserDetails->contactNum) && !empty($UserDetails->contactNum))
                                    <li style="display: flex; align-items: center; margin-bottom: 12px;">
                                        <i class="fa fa-phone" style="width: 20px; margin-right: 15px; opacity: 0.8;"></i>
                                        <a href="tel:{{ $UserDetails->contactNum }}" style="color: white; text-decoration: none;">
                                            {{ $UserDetails->contactNum }}
                                        </a>
                                    </li>
                                    @endif
                                    @if(isset($UserDetails->address) && !empty($UserDetails->address))
                                    <li style="display: flex; align-items: center; margin-bottom: 12px;">
                                        <i class="fa fa-map-marker" style="width: 20px; margin-right: 15px; opacity: 0.8;"></i>
                                        <span>{{ $UserDetails->address }}</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                            <div class="hero-cta wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                <div style="display: flex; gap: 20px; margin: 40px 0 30px 0; flex-wrap: wrap;">
                                    <a href="#mh-contact" style="
                                        background: rgba(255, 255, 255, 0.2);
                                        color: white;
                                        padding: 15px 30px;
                                        border-radius: 50px;
                                        text-decoration: none;
                                        font-weight: 600;
                                        backdrop-filter: blur(10px);
                                        border: 1px solid rgba(255, 255, 255, 0.3);
                                        transition: all 0.3s ease;
                                        display: inline-block;
                                    " onmouseover="this.style.background='rgba(255, 255, 255, 0.3)'; this.style.transform='translateY(-2px)'"
                                       onmouseout="this.style.background='rgba(255, 255, 255, 0.2)'; this.style.transform='translateY(0)'">
                                        <i class="fa fa-envelope" style="margin-right: 8px;"></i>
                                        Get In Touch
                                    </a>
                                    <a href="#mh-about" style="
                                        background: transparent;
                                        color: white;
                                        padding: 15px 30px;
                                        border-radius: 50px;
                                        text-decoration: none;
                                        font-weight: 600;
                                        border: 2px solid rgba(255, 255, 255, 0.3);
                                        transition: all 0.3s ease;
                                        display: inline-block;
                                    " onmouseover="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.transform='translateY(-2px)'"
                                       onmouseout="this.style.background='transparent'; this.style.transform='translateY(0)'">
                                        <i class="fa fa-user" style="margin-right: 8px;"></i>
                                        Learn More
                                    </a>
                                </div>
                            </div>

                            <ul class="social-icon wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">
                                @php
                                    $socialLinks = [
                                        'linkedin_profile' => ['icon' => 'fa-linkedin', 'url' => $UserDetails->linkedin_profile ?? null],
                                        'github_profile' => ['icon' => 'fa-github', 'url' => $UserDetails->github_profile ?? null],
                                        'twitter_profile' => ['icon' => 'fa-twitter', 'url' => $UserDetails->twitter_profile ?? null],
                                        'facebook_profile' => ['icon' => 'fa-facebook', 'url' => $UserDetails->facebook_profile ?? null],
                                        'instagram_profile' => ['icon' => 'fa-instagram', 'url' => $UserDetails->instagram_profile ?? null],
                                        'whatsapp_number' => ['icon' => 'fa-whatsapp', 'url' => isset($UserDetails->whatsapp_number) ? "https://api.whatsapp.com/send?phone=+91{$UserDetails->whatsapp_number}&text=Hi! I'd like to connect with you." : null]
                                    ];
                                @endphp

                                @foreach($socialLinks as $platform => $data)
                                    @if($data['url'])
                                        <li>
                                            <a href="{{ $data['url'] }}" target="_blank" rel="noopener noreferrer"
                                               title="{{ ucfirst(str_replace('_', ' ', $platform)) }}">
                                                <i class="fa {{ $data['icon'] }}"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @if($UserDetails->profilePic)
                    <div class="col-lg-6 col-md-12">
                        <div class="hero-img wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                            <div class="img-border">
                                <img src="{{ asset('storage/'.$UserDetails->profilePic) }}" alt="{{ $UserDetails->name }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!--
        ===================
           ABOUT
        ===================
        -->
        <section class="mh-about" id="mh-about">
            <div class="container">
                <div class="row section-separator">
                    <div class="col-sm-12 col-md-6">
                        <div class="mh-about-img shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                            <img src="{{asset('vikas_css/images/about_me.gif')}}" alt="About_me" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="mh-about-inner">
                            <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">About Me</h2>
                            @if($UserDetails->about)
                            <p class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">{{ $UserDetails->about }}</p>
                            @endif
                            @if($UserDetails->technologies)
                            <div class="mh-about-tag wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                <ul>
                                    @php
                                        $technologies = explode(',', $UserDetails->technologies);
                                    @endphp
                                    @foreach($technologies as $technology)
                                        <li><span>{{ trim($technology) }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if($UserDetails->resume_filename)
                            <a href="{{ asset('storage/'.$UserDetails->resume_filename) }}" class="btn btn-fill wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s" target="_blank">My CV <i class="fa fa-download"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--
        ===================
           SERVICE
        ===================
        -->
        <section class="mh-service">
            <div class="container">
                <div class="row section-separator">
                    @if(isset($UserDetails->action) && is_array($UserDetails->action) && isset($UserDetails->description) && is_array($UserDetails->description))
                    <div class="col-sm-12 text-center section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <h3>What I do</h3>
                    </div>
                        @foreach($UserDetails->action as $index => $action)
                            @if(isset($UserDetails->description[$index]))
                                <div class="col-sm-6">
                                    <div class="mh-service-item shadow-1 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="{{ 0.3 + ($index * 0.2) }}s">
                                            <i class="fa fa-code iron-color"></i>
                                        <h3>{{ $action }}</h3>
                                        <p>{{ $UserDetails->description[$index] }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <!--
        ===================
          FEATURE PROJECTS
        ===================
        -->
        <!-- <section class="mh-featured-project image-bg featured-img-one">
            <div class="img-color-overlay">
                <div class="container">
                    <div class="row section-separator">
                        <div class="section-title col-sm-12">
                            <h3>Featured Projects</h3>
                        </div>
                        <div class="col-sm-12">
                            <div class="mh-single-project-slide-by-side row"> -->
                                <!-- Project Items -->
                                <!-- <div class="col-sm-12 mh-featured-item">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="mh-featured-project-img shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                                <img src="{{asset('vikas_css/images/p-2.png')}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="mh-featured-project-content">
                                                <h4 class="project-category wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">Web Design</h4>
                                                <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s">Wrap</h2>
                                                <span class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">Design & Development</span>
                                                <p class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">Stamp is a clean and elegant Multipurpose Landing Page Template.
                                                It will fit perfectly for Startup, Web App or any type of Web Services.
                                                It has 4 background styles with 6 homepage styles. 6 pre-defined color scheme.
                                                All variations are organized separately so you can use / customize the template very easily.</p>
                                                <a href="#" class="btn btn-fill wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">View Details</a>
                                                <div class="mh-testimonial mh-project-testimonial wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.9s">
                                                    <blockquote>
                                    					<q>Excellent Template - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                    				<blockquote>
                                    					<q>Creative Template - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                    				<blockquote>
                                    					<q>Organize Code - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- Project Items -->
                                <!-- <div class="col-sm-12 mh-featured-item">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="mh-featured-project-img shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                                <img src="{{asset('vikas_css/images/p-2.png')}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="mh-featured-project-content">
                                                <h4 class="project-category wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">Web Design</h4>
                                                <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s">Wrap</h2>
                                                <span class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">Design & Development</span>
                                                <p class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">Stamp is a clean and elegant Multipurpose Landing Page Template.
                                                It will fit perfectly for Startup, Web App or any type of Web Services.
                                                It has 4 background styles with 6 homepage styles. 6 pre-defined color scheme.
                                                All variations are organized separately so you can use / customize the template very easily.</p>
                                                <a href="#" class="btn btn-fill wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">View Details</a>
                                                <div class="mh-testimonial mh-project-testimonial wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.9s">
                                                    <blockquote>
                                    					<q>Excellent Template - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                    				<blockquote>
                                    					<q>Creative Template - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                    				<blockquote>
                                    					<q>Organize Code - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- Project Items -->
                                <!-- <div class="col-sm-12 mh-featured-item">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="mh-featured-project-img shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                                <img src="{{asset('vikas_css/images/p-2.png')}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="mh-featured-project-content">
                                                <h4 class="project-category wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">Web Design</h4>
                                                <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s">Wrap</h2>
                                                <span class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">Design & Development</span>
                                                <p class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">Stamp is a clean and elegant Multipurpose Landing Page Template.
                                                It will fit perfectly for Startup, Web App or any type of Web Services.
                                                It has 4 background styles with 6 homepage styles. 6 pre-defined color scheme.
                                                All variations are organized separately so you can use / customize the template very easily.</p>
                                                <a href="#" class="btn btn-fill wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">View Details</a>
                                                <div class="mh-testimonial mh-project-testimonial wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.9s">
                                                    <blockquote>
                                    					<q>Excellent Template - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                    				<blockquote>
                                    					<q>Creative Template - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                    				<blockquote>
                                    					<q>Organize Code - suits my needs perfectly whilst allowing me to learn some new technology first hand.</q>
                                    					<cite>- Shane Kavanagh</cite>
                                    				</blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <!-- </div> End: .row -->
                <!-- </div>
            </div>
        </section>   -->

        <!--
        ===================
           SKILLS
        ===================
        -->
        <section class="mh-skills" id="mh-skills">
            <div class="home-v-img" style="align-items: center;">
                <div class="container">
                    <!-- <div class="row section-separator"> -->
                        <!-- <div class="section-title text-center col-sm-12"> -->
                            <!--<h2>Skills</h2>-->
                        <!-- </div> -->
                        <!-- <div class="col-sm-12 col-md-6">
                            <div class="mh-skills-inner">
                                <div class="mh-professional-skill wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                    <h3>Technical Skills</h3>
                                    <div class="each-skills">
                                        <div class="candidatos">
                                            <div class="parcial">
                                                <div class="info">
                                                    <div class="nome">PHP</div>
                                                    <div class="percentagem-num">86%</div>
                                                </div>
                                                <div class="progressBar">
                                                    <div class="percentagem" style="width: 86%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="candidatos">
                                            <div class="parcial">
                                                <div class="info">
                                                    <div class="nome">Java</div>
                                                    <div class="percentagem-num">46%</div>
                                                </div>
                                                <div class="progressBar">
                                                    <div class="percentagem" style="width: 46%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="candidatos">
                                            <div class="parcial">
                                                <div class="info">
                                                    <div class="nome">Python</div>
                                                    <div class="percentagem-num">38%</div>
                                                </div>
                                                <div class="progressBar">
                                                    <div class="percentagem" style="width: 38%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="candidatos">
                                            <div class="parcial">
                                                <div class="info">
                                                    <div class="nome">PHP</div>
                                                    <div class="percentagem-num">17%</div>
                                                </div>
                                                <div class="progressBar">
                                                    <div class="percentagem" style="width: 17%;"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="candidatos">
                                            <div class="parcial">
                                                <div class="info">
                                                    <div class="nome">Python</div>
                                                    <div class="percentagem-num">38%</div>
                                                </div>
                                                <div class="progressBar">
                                                    <div class="percentagem" style="width: 38%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="candidatos">
                                            <div class="parcial">
                                                <div class="info">
                                                    <div class="nome">PHP</div>
                                                    <div class="percentagem-num">17%</div>
                                                </div>
                                                <div class="progressBar">
                                                    <div class="percentagem" style="width: 17%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-12 col-md-10">
                            <div class="mh-professional-skills wow fadeInUp align" data-wow-duration="0.8s" data-wow-delay="0.5s">
                                <h3>Professional Skills</h3>
                                <ul class="mh-professional-progress">
                                    @if($UserDetails->communication)
                                    <li>
                                        <div class="mh-progress mh-progress-circle" data-progress="{{ $UserDetails->communication }}"></div>
                                        <div class="pr-skill-name">Communication</div>
                                    </li>
                                    @endif
                                    @if($UserDetails->team_work)
                                    <li>
                                        <div class="mh-progress mh-progress-circle" data-progress="{{ $UserDetails->team_work }}"></div>
                                        <div class="pr-skill-name">Team Work</div>
                                    </li>
                                    @endif
                                    @if($UserDetails->project_management)
                                    <li>
                                        <div class="mh-progress mh-progress-circle" data-progress="{{ $UserDetails->project_management }}"></div>
                                        <div class="pr-skill-name">Project Management</div>
                                    </li>
                                    @endif
                                    @if($UserDetails->creativity)
                                    <li>
                                        <div class="mh-progress mh-progress-circle" data-progress="{{ $UserDetails->creativity }}"></div>
                                        <div class="pr-skill-name">Creativity</div>
                                    </li>
                                    @endif
                                    @if($UserDetails->team_management)
                                    <li>
                                        <div class="mh-progress mh-progress-circle" data-progress="{{ $UserDetails->team_management }}"></div>
                                        <div class="pr-skill-name">Team Management</div>
                                    </li>
                                    @endif
                                    @if($UserDetails->active_participation)
                                    <li>
                                        <div class="mh-progress mh-progress-circle" data-progress="{{ $UserDetails->active_participation }}"></div>
                                        <div class="pr-skill-name">Active Participation</div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--
        ===================
           EXPERIENCES
        ===================
        -->
        <section class="mh-experince" id="mh-experience">
            <div class="img-color-overlay">
                <div class="container">
                    <div class="row section-separator">
                        <div class="col-sm-12 col-md-6">
                            @if($EducationDetails && $EducationDetails->count() > 0)
                            <div class="mh-education">
                                <h3 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">Education</h3>
                                @foreach ($EducationDetails as $education)
                                <div class="mh-education-deatils">
                                    <div class="mh-education-item wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                        @if($education->degree || $education->university)
                                        <h4>{{ $education->degree }} From {{ $education->university }}</h4>
                                        @endif
                                        @if($education->from_date && $education->to_date)
                                        <div class="mh-eduyear">{{ $education->from_date }} to {{ $education->to_date }}</div>
                                        @endif
                                        @if($education->description)
                                        <p>{{ $education->description }}</p>
                                        @endif
                                    </div>
                                </div><br>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-6">
                            @if($WorkExperiences && $WorkExperiences->count() > 0)
                            <div class="mh-work">
                                 <h3>Work Experience</h3>
                                 @foreach ($WorkExperiences as $work)
                                <div class="mh-experience-deatils">
                                    {{-- <div class="mh-work-item dark-bg wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInUp;">

                                        <h4>{{ $work->position }} at {{ $work->organization }}</h4>
                                        <div class="mh-eduyear">{{ $work->from_date }} to {{ $work->to_date }}</div>
                                        <span>Roles &amp; Responsibility :</span>
                                         @if($work->roles_and_responsibilities)
                                        <p>{{ $work->roles_and_responsibilities }}</p>
                                        @endif
                                    </div> --}}
                                    <div class="mh-work-item wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInUp;">
                                        @if($work->position && $work->organization)
                                        <h4>{{ $work->position }} at {{ $work->organization }}</h4>
                                        @endif
                                        @if($work->from_date)
                                        <div class="mh-eduyear">{{ $work->from_date }} to {{ $work->to_date ? $work->to_date : 'till date' }}</div>
                                        @endif
                                        <span>Roles &amp; Responsibility :</span>
                                         @if($work->roles_and_responsibilities)
                                        <p>{{ $work->roles_and_responsibilities }}</p>
                                        @endif
                                    </div>
                                </div><br>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--
        ===================
           BLOGS
        ===================
        -->
        <section class="mh-blog" id="mh-blogs">
            <div class="container">
                <div class="row section-separator">
                    <div class="col-sm-12 text-center section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <h3>Latest Blogs</h3>
                    </div>
                    <div class="col-sm-12">
                        @if($blogs && $blogs->count() > 0)
                            <div class="mh-blog-slider owl-carousel wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                @foreach($blogs as $blog)
                                <!-- Blog Item -->
                                <div class="item">
                                    <div class="mh-blog-item shadow-1">
                                        <div class="blog-inner">
                                            <div class="mh-blog-img">
                                                <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank">
                                                    @if($blog->featured_image)
                                                        <img src="{{ asset('storage/'.$blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid">
                                                    @else
                                                        <img src="{{asset('vikas_css/images/contact.gif')}}" alt="{{ $blog->title }}" class="img-fluid">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="mh-blog-info">
                                                <div class="mh-blog-meta">
                                                    <span class="blog-date">{{ $blog->published_at ? $blog->published_at->format('d M, Y') : $blog->created_at->format('d M, Y') }}</span>
                                                    @if($blog->tags && is_array($blog->tags) && count($blog->tags) > 0)
                                                        <span class="blog-category">{{ $blog->tags[0] }}</span>
                                                    @endif
                                                    @if($blog->reading_time)
                                                        <span class="blog-reading-time">{{ $blog->reading_time }} min read</span>
                                                    @endif
                                                </div>
                                                <h3><a href="{{ route('blogs.show', $blog->slug) }}" target="_blank">{{ $blog->title }}</a></h3>
                                                <p>{{ Str::limit($blog->description, 120, '...') }}</p>
                                                <div class="mh-blog-footer">
                                                    <div class="blog-read-more">
                                                        <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="btn btn-outline">Read More</a>
                                                    </div>
                                                    @if($blog->views_count)
                                                        <div class="blog-views">
                                                            <span><i class="fa fa-eye"></i> {{ $blog->views_count }} views</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="mh-no-blogs text-center wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                <div class="no-blogs-content">
                                    <div class="no-blogs-icon">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </div>
                                    <h4>No Blogs Available</h4>
                                    <p class="text-muted">I haven't published any blog posts yet. Stay tuned for upcoming articles where I'll share insights about web development, programming tips, and industry best practices.</p>
                                    <div class="coming-soon-badge">
                                        <span class="badge-text">Coming Soon</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!--
        ===================
           PORTFOLIO
        ===================
        -->
        <!-- <section class="mh-portfolio" id="mh-portfolio">
            <div class="container">
                <div class="row section-separator">
                    <div class="section-title col-sm-12 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
                        <h3>Recent Portfolio</h3>
                    </div>
                    <div class="part col-sm-12">
                        <div class="portfolio-nav col-sm-12" id="filter-button">
                            <ul>
                                <li data-filter="*" class="current wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s"> <span>All Categories</span></li>
                                <li data-filter=".user-interface" class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s"><span>Web Design</span></li>
                                <li data-filter=".branding" class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s"><span>Branding</span></li>
                                <li data-filter=".mockup" class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s"><span>Mockups</span></li>
                                <li data-filter=".ui" class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s"><span>Photography</span></li>
                            </ul>
                        </div>
                        <div class="mh-project-gallery col-sm-12 wow fadeInUp" id="project-gallery" data-wow-duration="0.8s" data-wow-delay="0.5s">
                            <div class="portfolioContainer row">
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 user-interface">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g1.jpg')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a data-fancybox data-src="#mh"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 ui mockup">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g2.png')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a href="{{asset('vikas_css/images/portfolio/g2.png')}}" data-fancybox data-src="#mh"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 user-interface">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g3.png')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a href="{{asset('vikas_css/images/portfolio/g3.png')}}" data-fancybox data-src="#mh"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 branding">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g5.png')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a href="{{asset('vikas_css/images/portfolio/g5.png')}}" data-fancybox data-src="#mh"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 user-interface">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g4.png')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a href="{{asset('vikas_css/images/portfolio/g4.png')}}" data-fancybox data-src="#mh"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 branding">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g6.png')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a href="{{asset('vikas_css/images/portfolio/g6.png')}}" data-fancybox data-src="#mh"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 branding">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g8.png')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a href="{{asset('vikas_css/images/portfolio/g8.png')}}" data-fancybox data-src="#mh"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 ui">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g9.png')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a href="{{asset('vikas_css/images/portfolio/g9.png')}}" data-fancybox data-src="#mh"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="grid-item col-md-4 col-sm-6 col-xs-12 branding">
                                    <figure>
                                        <img src="{{asset('vikas_css/images/portfolio/g7.jpg')}}" alt="img04">
                                        <figcaption class="fig-caption">
                                            <i class="fa fa-search"></i>
                                            <h5 class="title">Creative Design</h5>
                                            <span class="sub-title">Photograpy</span>
                                            <a href="{{asset('vikas_css/images/portfolio/g7.jpg')}}" data-fancybox="gallery"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div> <!-- End: .grid .project-gallery -->
                        </div> <!-- End: .grid .project-gallery -->
                    </div> <!-- End: .part -->
                </div> <!-- End: .row -->
            <!-- </div>
            <div class="mh-portfolio-modal" id="mh">
                <div class="container">
                    <div class="row mh-portfolio-modal-inner">
                        <div class="col-sm-5">
                            <h2>Wrap - A campanion plugin</h2>
                            <p>Wrap is a clean and elegant Multipurpose Landing Page Template.
                            It will fit perfectly for Startup, Web App or any type of Web Services.
                            It has 4 background styles with 6 homepage styles. 6 pre-defined color scheme.
                            All variations are organized separately so you can use / customize the template very easily.</p>

                            <p>It is a clean and elegant Multipurpose Landing Page Template.
                            It will fit perfectly for Startup, Web App or any type of Web Services.
                            It has 4 background styles with 6 homepage styles. 6 pre-defined color scheme.
                            All variations are organized separately so you can use / customize the template very easily.</p>
                            <div class="mh-about-tag">
                                <ul>
                                    <li><span>php</span></li>
                                    <li><span>html</span></li>
                                    <li><span>css</span></li>
                                    <li><span>php</span></li>
                                    <li><span>wordpress</span></li>
                                    <li><span>React</span></li>
                                    <li><span>Javascript</span></li>
                                </ul>
                            </div>
                            <a href="#" class="btn btn-fill">Live Demo</a>
                        </div>
                        <div class="col-sm-7">
                            <div class="mh-portfolio-modal-img">
                                <img src="{{asset('vikas_css/images/pr-0.jif')}}" alt="" class="img-fluid">
                                <p>All variations are organized separately so you can use / customize the template very easily.</p>
                                <img src="{{asset('vikas_css/images/pr-1.jif')}}" alt="" class="img-fluid">
                                <p>All variations are organized separately so you can use / customize the template very easily.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <footer class="mh-footer mh-footer-3" id="mh-contact">
            <div class="container-fluid">
                <div class="row section-separator">
                    <div class="col-sm-12 section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <h3>Contact Me</h3>
                    </div>
                    <div class="map-image col-sm-12">
                        <div class="container mt-30">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 mh-footer-address">
                                    <div class="col-sm-12 xs-no-padding">
                                        <div class="mh-address-footer-item shadow-1 media wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                            <div class="each-icon">
                                                <i class="fa fa-location-arrow"></i>
                                            </div>
                                            <div class="each-info media-body">
                                                <h4>Address</h4>
                                                <address>
                                                    {{ $UserDetails->address ? $UserDetails->address : 'Not Available' }}
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 xs-no-padding">
                                        <div class="mh-address-footer-item shadow-1 media wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                                            <div class="each-icon">
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                            <div class="each-info media-body">
                                                <h4>Email</h4>
                                                <a href="mailto:{{ $UserDetails->email }}">{{ $UserDetails->email }}</a><br>
                                            </div>
                                        </div>
                                    </div>
                                    @if($UserDetails->contactNum)
                                    <div class="col-sm-12 xs-no-padding">
                                        <div class="mh-address-footer-item shadow-1 media wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                            <div class="each-icon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="each-info media-body">
                                                <h4>Phone</h4>
                                                <a href="callto:{{ $UserDetails->contactNum }}">{{ $UserDetails->contactNum }}</a><br>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-6 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                    <img src="{{asset('vikas_css/images/contact.gif')}}" alt="contact_me" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Website Attribution -->
        <div class="website-attribution text-center" style="background: #000; padding: 15px 0; margin-top: 30px;">
            <div class="container">
                <p style="color: #999; margin: 0; font-size: 14px;">
                    Developed and maintained by <a href="https://meetmytech.com" target="_blank" style="color: #f9bf3b; text-decoration: none;">meetmytech.com</a>
                </p>
            </div>
        </div>

    <!--
    ==============
    * JS Files *
    ==============
    -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <!-- jQuery -->
    <script src="{{asset('vikas_css/plugins/js/jquery.min.js')}}"></script>
    <!-- popper -->
    <script src="{{asset('vikas_css/plugins/js/popper.min.js')}}"></script>
    <!-- bootstrap -->
    <script src="{{asset('vikas_css/plugins/js/bootstrap.min.js')}}"></script>
    <!-- owl carousel -->
    <script src="{{asset('vikas_css/plugins/js/owl.carousel.js')}}"></script>
    <!-- validator -->
    <script src="{{asset('vikas_css/plugins/js/validator.min.js')}}"></script>
    <!-- wow -->
    <script src="{{asset('vikas_css/plugins/js/wow.min.js')}}"></script>
    <!-- mixin js-->
    <script src="{{asset('vikas_css/plugins/js/jquery.mixitup.min.js')}}"></script>
    <!-- circle progress-->
    <script src="{{asset('vikas_css/plugins/js/circle-progress.js')}}"></script>
    <!-- jquery nav -->
    <script src="{{asset('vikas_css/plugins/js/jquery.nav.js')}}"></script>
    <!-- Fancybox js-->
    <script src="{{asset('vikas_css/plugins/js/jquery.fancybox.min.js')}}"></script>
    <!-- Map api -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyCRP2E3BhaVKYs7BvNytBNumU0MBmjhhxc" async defer></script>
    <!-- isotope js-->
    <script src="{{asset('vikas_css/plugins/js/isotope.pkgd.js')}}"></script>
    <script src="{{asset('vikas_css/plugins/js/packery-mode.pkgd.js')}}"></script>
    <!-- Custom Scripts-->
    <script src="{{asset('vikas_css/js/map-init.js')}}"></script>
    <script src="{{asset('vikas_css/js/custom-scripts.js')}}"></script>
    <script src="{{asset('vikas_css/js/blog-carousel.js')}}"></script>


    {{-- Dynamic Footer Script --}}
    @if(isset($UserDetails->tawk_js) && !empty($UserDetails->tawk_js))
        {!! $UserDetails->tawk_js !!}
    @endif
</main>
</body>

</html>
