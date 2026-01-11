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

    {{-- Performance Optimization - Resource Hints --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://maps.googleapis.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

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
    <link rel="preconnect" href="https://maps.googleapis.com">

    {{-- Critical CSS first --}}
    <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vikas_css/css/styles.css') }}">

    {{-- Non-critical CSS loaded asynchronously --}}
    <link rel="preload" href="{{ asset('vikas_css/icons/font-awesome-4.7.0/css/font-awesome.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('vikas_css/plugins/css/animate.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('vikas_css/plugins/css/owl.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('vikas_css/plugins/css/jquery.fancybox.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('vikas_css/css/responsive.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('vikas_css/css/blog-section.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    {{-- Fallback for browsers that don't support preload --}}
    <noscript>
        <link rel="stylesheet" href="{{ asset('vikas_css/icons/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/owl.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('vikas_css/css/blog-section.css') }}">
    </noscript>

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
</head>
    {{-- <body class="white-version black-bg" data-spy="scroll" data-target="#navbar" data-offset="50"> --}}
    <body class="dark-vertion black-bg" data-spy="scroll" data-target="#navbar" data-offset="50">
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
        <header class="black-bg mh-header mh-fixed-nav nav-scroll mh-xs-mobile-nav" id="mh-header">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg mh-nav nav-btn">
                        @if($UserDetails->logo_png)
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('storage/'.$UserDetails->logo_png) }}" alt="{{ $UserDetails->name }}" class="img-fluid" width="64" height="64" loading="lazy" decoding="async">
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
           Home
        ===================
        -->
        <section class="mh-home image-bg home-2-img" id="mh-home">
            <div class="img-foverlay img-color-overlay">
                <div class="container">
                    <div class="row section-separator xs-column-reverse vertical-middle-content home-padding">
                        <div class="col-sm-6">
                            <div class="mh-header-info">
                                <div class="mh-promo wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
                                    <span>Hello I'm called</span>
                                </div>

                                <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">{{ $UserDetails->name }}</h2>
                                <h4 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                    @if($WorkExperiences && $WorkExperiences->count() > 0)
                                        {{ $WorkExperiences->first()->position }}
                                        @if($WorkExperiences->first()->to_date === null)
                                            <small class="text-muted"> (Current)</small>
                                        @endif
                                    @else
                                        Software Developer
                                    @endif
                                </h4>

                                <ul>
                                    <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s"><i class="fa fa-envelope"></i><a href="mailto:">{{ $UserDetails->email }}</a></li>
                                    @if(isset($UserDetails->contactNum) && !empty($UserDetails->contactNum))
                                    <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s"><i class="fa fa-phone"></i><a href="tel:{{ $UserDetails->contactNum }}">{{ $UserDetails->contactNum }}</a></li>
                                    @endif
                                    @if(isset($UserDetails->address) && !empty($UserDetails->address))
                                    <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s"><i class="fa fa-map-marker"></i><address>{{ $UserDetails->address }}</address></li>
                                    @endif
                                </ul>

                                <ul class="social-icon wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">
                                    @php
                                        $socialLinks = [
                                            'facebook_profile' => ['icon' => 'fa-facebook', 'url' => $UserDetails->facebook_profile ?? null],
                                            'instagram_profile' => ['icon' => 'fa-instagram', 'url' => $UserDetails->instagram_profile ?? null],
                                            'linkedin_profile' => ['icon' => 'fa-linkedin', 'url' => $UserDetails->linkedin_profile ?? null],
                                            'github_profile' => ['icon' => 'fa-github', 'url' => $UserDetails->github_profile ?? null],
                                            'twitter_profile' => ['icon' => 'fa-twitter', 'url' => $UserDetails->twitter_profile ?? null],
                                            'whatsapp_number' => ['icon' => 'fa-whatsapp', 'url' => isset($UserDetails->whatsapp_number) ? "https://api.whatsapp.com/send?phone=+91{$UserDetails->whatsapp_number}&text=Write to me for more details" : null]
                                        ];
                                    @endphp

                                    @foreach($socialLinks as $platform => $data)
                                        @if($data['url'])
                                            <li><a href="{{ $data['url'] }}" target="_blank" rel="noopener noreferrer"><i class="fa {{ $data['icon'] }}"></i></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if($UserDetails->profilePic)
                        <div class="col-sm-6">
                            <div class="hero-img wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                <div class="img-border">
                                    <img src="{{ asset('storage/'.$UserDetails->profilePic) }}" alt="{{ $UserDetails->name }} Profile Picture" class="img-fluid" width="400" height="400" loading="eager" decoding="sync">
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
           ABOUT
        ===================
        -->
        <section class="mh-about" id="mh-about">
            <div class="container">
                <div class="row section-separator">
                    <div class="col-sm-12 col-md-6">
                        <div class="mh-about-img shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                            <img src="{{asset('vikas_css/images/about_me.gif')}}" alt="About_me" class="img-fluid" loading="lazy" decoding="async">
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
                                    <div class="mh-service-item shadow-1 dark-bg wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="{{ 0.3 + ($index * 0.2) }}s">
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
        <section class="mh-experince image-bg featured-img-one" id="mh-experience">
            <div class="img-color-overlay">
                <div class="container">
                    <div class="row section-separator">
                        <div class="col-sm-12 col-md-6">
                            @if($EducationDetails && $EducationDetails->count() > 0)
                            <div class="mh-education">
                                <h3 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">Education</h3>
                                @foreach ($EducationDetails as $education)
                                <div class="mh-education-deatils">
                                    <div class="mh-education-item dark-bg wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
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
                                    <div class="mh-work-item dark-bg wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInUp;">
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
                            <!-- Desktop Blog Container -->
                            <div class="desktop-blog-container">
                                <div class="mh-blog-slider owl-carousel wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                    @foreach($blogs as $blog)
                                    <!-- Blog Item -->
                                    <div class="item">
                                        <div class="mh-blog-item dark-bg shadow-1">
                                            <div class="blog-inner">
                                                <div class="mh-blog-img">
                                                    <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank">
                                                        @if($blog->featured_image)
                                                            <img src="{{ asset('storage/'.$blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid" width="400" height="250" loading="lazy" decoding="async">
                                                        @else
                                                            <img src="{{asset('vikas_css/images/contact.gif')}}" alt="{{ $blog->title }}" class="img-fluid" width="400" height="250" loading="lazy" decoding="async">
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
                                                            <span class="blog-reading-time">{{ $blog->reading_time }}</span>
                                                        @endif
                                                    </div>
                                                    <h3><a href="{{ route('blogs.show', $blog->slug) }}" target="_blank">{{ Str::limit($blog->title, 60, '...') }}</a></h3>
                                                    <p>{{ Str::limit($blog->description, 100, '...') }}</p>
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
                            </div>

                            <!-- Mobile Blog Container -->
                            <div class="mobile-blog-container">
                                <div class="row">
                                    @foreach($blogs->take(6) as $blog)
                                    <div class="col-12 col-sm-6 mb-4">
                                        <article class="card h-100 shadow-sm blog-card">
                                            @if($blog->featured_image)
                                                <img
                                                    src="{{ asset('storage/' . $blog->featured_image) }}"
                                                    alt="{{ $blog->title }}"
                                                    class="card-img-top"
                                                    style="height: 180px; object-fit: cover;"
                                                    width="300"
                                                    height="180"
                                                    loading="lazy"
                                                    decoding="async"
                                                >
                                            @else
                                                <div class="card-img-top bg-gradient d-flex align-items-center justify-content-center" style="height: 180px;">
                                                    <span class="text-white h4 font-weight-bold">{{ substr($blog->title, 0, 1) }}</span>
                                                </div>
                                            @endif

                                            <div class="card-body d-flex flex-column">
                                                <div class="blog-meta mb-3">
                                                    <small class="text-muted d-block">
                                                        <i class="fa fa-calendar"></i> {{ $blog->published_at ? $blog->published_at->format('M j, Y') : $blog->created_at->format('M j, Y') }}
                                                        @if($blog->views_count)
                                                            • <i class="fa fa-eye"></i> {{ $blog->views_count }} views
                                                        @endif
                                                    </small>
                                                    @if($blog->reading_time)
                                                        <small class="text-muted">
                                                            <i class="fa fa-clock-o"></i> {{ $blog->reading_time }}
                                                        </small>
                                                    @endif
                                                </div>

                                                <h5 class="card-title">
                                                    <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="text-decoration-none" style="color: #fff;">
                                                        {{ Str::limit($blog->title, 60, '...') }}
                                                    </a>
                                                </h5>

                                                @if($blog->description)
                                                    <p class="card-text text-muted flex-grow-1 line-clamp-3">{{ Str::limit($blog->description, 100, '...') }}</p>
                                                @endif

                                                <div class="mt-auto">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a
                                                            href="{{ route('blogs.show', $blog->slug) }}"
                                                            target="_blank"
                                                            class="btn btn-outline-warning btn-sm"
                                                            style="border-color: #f9bf3b; color: #f9bf3b;"
                                                        >
                                                            Read more <i class="fa fa-arrow-right"></i>
                                                        </a>

                                                        @if($blog->tags && is_array($blog->tags) && count($blog->tags) > 0)
                                                            <div class="tags">
                                                                @foreach(array_slice($blog->tags, 0, 1) as $tag)
                                                                    <span class="badge" style="background: #f9bf3b; color: #1e1e1e; font-size: 0.7rem;">{{ $tag }}</span>
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

                                @if($blogs->count() > 6)
                                <div class="row">
                                    <div class="col-12 text-center mt-4">
                                        <a href="/all-blogs" class="btn btn-outline-warning" style="background: #f9bf3b; color: #1e1e1e; border-color: #f9bf3b; padding: 12px 24px; border-radius: 25px; font-weight: 600;">
                                            <i class="fa fa-list"></i> View All {{ $blogs->count() }} Blogs
                                        </a>
                                    </div>
                                </div>
                                @endif
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
                                        <img src="{{asset('vikas_css/images/portfolio/g1.jpg')}}" alt="img04" loading="lazy" decoding="async">
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
                                        <img src="{{asset('vikas_css/images/portfolio/g2.png')}}" alt="img04" loading="lazy" decoding="async">
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
                                        <img src="{{asset('vikas_css/images/portfolio/g3.png')}}" alt="img04" loading="lazy" decoding="async">
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
                    <div class="map-image image-bg col-sm-12">
                        <div class="container mt-30">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 mh-footer-address">
                                    <div class="col-sm-12 xs-no-padding">
                                        <div class="mh-address-footer-item dark-bg shadow-1 media wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
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
                                        <div class="mh-address-footer-item media dark-bg shadow-1 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
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
                                        <div class="mh-address-footer-item media dark-bg shadow-1 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">
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

    <!-- Critical JavaScript loaded first -->
    <script src="{{asset('vikas_css/plugins/js/jquery.min.js')}}"></script>
    <script src="{{asset('vikas_css/plugins/js/popper.min.js')}}"></script>
    <script src="{{asset('vikas_css/plugins/js/bootstrap.min.js')}}"></script>

    <!-- Non-critical JavaScript loaded with defer -->
    <script src="{{asset('vikas_css/plugins/js/owl.carousel.js')}}" defer></script>
    <script src="{{asset('vikas_css/plugins/js/validator.min.js')}}" defer></script>
    <script src="{{asset('vikas_css/plugins/js/wow.min.js')}}" defer></script>
    <script src="{{asset('vikas_css/plugins/js/jquery.mixitup.min.js')}}" defer></script>
    <script src="{{asset('vikas_css/plugins/js/circle-progress.js')}}" defer></script>
    <script src="{{asset('vikas_css/plugins/js/jquery.nav.js')}}" defer></script>
    <script src="{{asset('vikas_css/plugins/js/jquery.fancybox.min.js')}}" defer></script>
    <script src="{{asset('vikas_css/plugins/js/isotope.pkgd.js')}}" defer></script>
    <script src="{{asset('vikas_css/plugins/js/packery-mode.pkgd.js')}}" defer></script>

    <!-- Custom Scripts with defer -->
    <script src="{{asset('vikas_css/js/map-init.js')}}" defer></script>
    <script src="{{asset('vikas_css/js/custom-scripts.js')}}" defer></script>
    <script src="{{asset('vikas_css/js/blog-carousel.js')}}" defer></script>

    <!-- Map API loaded asynchronously -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyCRP2E3BhaVKYs7BvNytBNumU0MBmjhhxc" async defer></script>


    {{-- Dynamic Footer Script --}}
    @if(isset($UserDetails->tawk_js) && !empty($UserDetails->tawk_js))
        {!! $UserDetails->tawk_js !!}
    @endif
</main>
</body>

</html>
