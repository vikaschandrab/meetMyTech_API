<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    use Illuminate\Support\Str;

    $pageTitle = $UserDetails->name . ' - Personal CV/Resume';
    $seoDescription = $UserDetails->seo_description ?? null;
    $seoKeywords = $UserDetails->seo_keywords ?? null;
    $profilePicUrl = $UserDetails->profilePic ? asset('storage/' . $UserDetails->profilePic) : null;
    $logoPngUrl = $UserDetails->logo_png ? asset('storage/' . $UserDetails->logo_png) : null;

    $faviconIco = $UserDetails->logo_16_14_ico ? asset('storage/' . $UserDetails->logo_16_14_ico) : null;
    $favicon32 = $UserDetails->logo_16_14_png ? asset('storage/' . $UserDetails->logo_16_14_png) : null;
    $favicon72 = $UserDetails->logo_72_72_png ? asset('storage/' . $UserDetails->logo_72_72_png) : null;
    $favicon114 = $UserDetails->logo_114_114_png ? asset('storage/' . $UserDetails->logo_114_114_png) : null;

    $currentRole = 'Software Developer';
    if ($WorkExperiences && $WorkExperiences->count() > 0) {
        $currentRole = $WorkExperiences->first()->position ?: $currentRole;
    }

    $socialLinks = [
        'facebook_profile' => ['icon' => 'fa-facebook', 'url' => $UserDetails->facebook_profile ?? null],
        'instagram_profile' => ['icon' => 'fa-instagram', 'url' => $UserDetails->instagram_profile ?? null],
        'linkedin_profile' => ['icon' => 'fa-linkedin', 'url' => $UserDetails->linkedin_profile ?? null],
        'github_profile' => ['icon' => 'fa-github', 'url' => $UserDetails->github_profile ?? null],
        'twitter_profile' => ['icon' => 'fa-twitter', 'url' => $UserDetails->twitter_profile ?? null],
        'whatsapp_number' => ['icon' => 'fa-whatsapp', 'url' => isset($UserDetails->whatsapp_number) ? "https://api.whatsapp.com/send?phone=+91{$UserDetails->whatsapp_number}&text=Write%20to%20me%20for%20more%20details" : null]
    ];

    $strengths = [
        'Communication' => $UserDetails->communication ?? null,
        'Team Work' => $UserDetails->team_work ?? null,
        'Project Management' => $UserDetails->project_management ?? null,
        'Creativity' => $UserDetails->creativity ?? null,
        'Team Management' => $UserDetails->team_management ?? null,
        'Active Participation' => $UserDetails->active_participation ?? null,
    ];
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    @if($seoDescription)
    <meta name="description" content="{{ $seoDescription }}">
    @endif
    @if($seoKeywords)
    <meta name="keywords" content="{{ $seoKeywords }}">
    @endif
    <meta name="author" content="{{ $UserDetails->name }}">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="{{ $pageTitle }}">
    @if ($seoDescription)
    <meta property="og:description" content="{{ $seoDescription }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($profilePicUrl)
    <meta property="og:image" content="{{ $profilePicUrl }}">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="Skilled developer with 7+ years of experience in web development">
    @if($profilePicUrl)
    <meta name="twitter:image" content="{{ $profilePicUrl }}">
    @endif

    @if($faviconIco && $favicon32 && $favicon72 && $favicon114)
    <link rel="icon" type="image/x-icon" href="{{ $faviconIco }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $favicon32 }}">
    <link rel="icon" type="image/png" sizes="72x72" href="{{ $favicon72 }}">
    <link rel="icon" type="image/png" sizes="114x114" href="{{ $favicon114 }}">
    <link rel="apple-touch-icon" href="{{ $favicon114 }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Manrope:wght@300;400;500;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('vikas_css/plugins/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vikas_css/icons/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">

    @stack('styles')
</head>
<body class="portfolio-page">
<main>
    <header class="site-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="#home">
                    @if($logoPngUrl)
                        <img src="{{ $logoPngUrl }}" alt="{{ $UserDetails->name }}" width="48" height="48" loading="lazy" decoding="async">
                    @else
                        <span>{{ $UserDetails->name }}</span>
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#portfolioNav" aria-controls="portfolioNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="portfolioNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#strengths">Strengths</a></li>
                        <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                        <li class="nav-item"><a class="nav-link" href="#blogs">Blogs</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="hero-tag"><i class="fa fa-star"></i> Portfolio</span>
                    <h1 class="hero-title">{{ $UserDetails->name }}</h1>
                    <p class="hero-role">{{ $currentRole }}</p>
                    @if($UserDetails->about)
                        <p class="text-muted">{{ Str::limit($UserDetails->about, 200, '...') }}</p>
                    @endif
                    <div class="hero-actions mt-4">
                        <a href="#contact" class="btn btn-accent mr-2">Let us connect</a>
                        @if($UserDetails->resume_filename)
                            <a href="{{ asset('storage/'.$UserDetails->resume_filename) }}" target="_blank" rel="noopener noreferrer" class="btn btn-ghost">Download CV</a>
                        @endif
                    </div>
                    <div class="social-links">
                        @foreach($socialLinks as $platform => $data)
                            @if($data['url'])
                                <a href="{{ $data['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $platform }}">
                                    <i class="fa {{ $data['icon'] }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="hero-card">
                        @if($profilePicUrl)
                            <img src="{{ $profilePicUrl }}" alt="{{ $UserDetails->name }} Profile" loading="eager" decoding="sync">
                        @else
                            <img src="{{ asset('vikas_css/images/about_me.gif') }}" alt="Profile placeholder" loading="lazy" decoding="async">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="about">
        <div class="container">
            <div class="section-title"><span></span><h2>About</h2></div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card-elegant">
                        <h4>Who I am</h4>
                        @if($UserDetails->about)
                            <p class="text-muted">{{ $UserDetails->about }}</p>
                        @else
                            <p class="text-muted">A passionate developer crafting delightful digital experiences.</p>
                        @endif
                        @if($UserDetails->address)
                            <p class="text-muted"><i class="fa fa-map-marker"></i> {{ $UserDetails->address }}</p>
                        @endif
                        <p class="text-muted"><i class="fa fa-envelope"></i> <a href="mailto:{{ $UserDetails->email }}">{{ $UserDetails->email }}</a></p>
                        @if($UserDetails->contactNum)
                            <p class="text-muted"><i class="fa fa-phone"></i> <a href="tel:{{ $UserDetails->contactNum }}">{{ $UserDetails->contactNum }}</a></p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-elegant">
                        <h4>Tools and Technologies</h4>
                        @if($UserDetails->technologies)
                            @php $technologies = explode(',', $UserDetails->technologies); @endphp
                            <div class="chip-list">
                                @foreach($technologies as $technology)
                                    <span class="chip">{{ trim($technology) }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Technology stack details coming soon.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($UserDetails->action) && is_array($UserDetails->action) && isset($UserDetails->description) && is_array($UserDetails->description))
    <section class="section" id="services">
        <div class="container">
            <div class="section-title"><span></span><h2>Services</h2></div>
            <div class="row">
                @foreach($UserDetails->action as $index => $action)
                    @if(isset($UserDetails->description[$index]))
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card-elegant h-100">
                                <h5>{{ $action }}</h5>
                                <p class="text-muted">{{ $UserDetails->description[$index] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="section" id="strengths">
        <div class="container">
            <div class="section-title"><span></span><h2>Core Strengths</h2></div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card-elegant">
                        <h5>Professional strengths</h5>
                        <div class="strength-bar mt-3">
                            @foreach($strengths as $label => $value)
                                @if(!is_null($value))
                                    <div>
                                        <div class="label"><span>{{ $label }}</span><span>{{ (int) $value }}%</span></div>
                                        <div class="track"><div class="fill" style="width: {{ (int) $value }}%;"></div></div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-elegant">
                        <h5>Highlights</h5>
                        <ul class="text-muted">
                            <li>Clean architecture and maintainable codebases</li>
                            <li>Reliable delivery across teams and timelines</li>
                            <li>User-focused interfaces and performance-first builds</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="experience">
        <div class="container">
            <div class="section-title"><span></span><h2>Experience & Education</h2></div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card-elegant">
                        <h4>Work Experience</h4>
                        <div class="timeline mt-3">
                            @if($WorkExperiences && $WorkExperiences->count() > 0)
                                @foreach ($WorkExperiences as $work)
                                    <div class="timeline-item">
                                        @if($work->position && $work->organization)
                                            <h5>{{ $work->position }} at {{ $work->organization }}</h5>
                                        @endif
                                        @if($work->from_date)
                                            <div class="date">{{ $work->from_date }} to {{ $work->to_date ? $work->to_date : 'till date' }}</div>
                                        @endif
                                        @if($work->roles_and_responsibilities)
                                            <p class="text-muted">{{ $work->roles_and_responsibilities }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">Experience details will appear here.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-elegant">
                        <h4>Education</h4>
                        <div class="timeline mt-3">
                            @if($EducationDetails && $EducationDetails->count() > 0)
                                @foreach ($EducationDetails as $education)
                                    <div class="timeline-item">
                                        @if($education->degree || $education->university)
                                            <h5>{{ $education->degree }} @ {{ $education->university }}</h5>
                                        @endif
                                        @if($education->from_date && $education->to_date)
                                            <div class="date">{{ $education->from_date }} to {{ $education->to_date }}</div>
                                        @endif
                                        @if($education->description)
                                            <p class="text-muted">{{ $education->description }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">Education details will appear here.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="blogs">
        <div class="container">
            <div class="section-title"><span></span><h2>Latest Blogs</h2></div>
            @if($blogs && $blogs->count() > 0)
                <div class="blog-grid">
                    @foreach($blogs->take(6) as $blog)
                        <article class="blog-card">
                            <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" rel="noopener noreferrer">
                                @if($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" loading="lazy" decoding="async">
                                @else
                                    <img src="{{ asset('vikas_css/images/contact.gif') }}" alt="{{ $blog->title }}" loading="lazy" decoding="async">
                                @endif
                            </a>
                            <div class="blog-card-body">
                                <div class="text-muted" style="font-size: 13px;">
                                    <i class="fa fa-calendar"></i>
                                    {{ $blog->published_at ? $blog->published_at->format('M j, Y') : $blog->created_at->format('M j, Y') }}
                                    @if($blog->reading_time)
                                        · {{ $blog->reading_time }} min read
                                    @endif
                                </div>
                                <h5><a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" rel="noopener noreferrer">{{ Str::limit($blog->title, 60, '...') }}</a></h5>
                                @if($blog->description)
                                    <p class="text-muted">{{ Str::limit($blog->description, 100, '...') }}</p>
                                @endif
                                <div class="mt-auto">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">Read more</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                @if($blogs->count() > 6)
                    <div class="text-center mt-4">
                        <a href="/all-blogs" class="btn btn-accent">View All {{ $blogs->count() }} Blogs</a>
                    </div>
                @endif
            @else
                <div class="card-elegant">
                    <p class="text-muted mb-0">No blogs available yet. Stay tuned for updates.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="section" id="contact">
        <div class="container">
            <div class="section-title"><span></span><h2>Contact</h2></div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="contact-card">
                        <h4>Let us build something meaningful</h4>
                        <p class="text-muted">Share your project details and I will get back to you with a plan.</p>
                        <p><i class="fa fa-envelope"></i> <a href="mailto:{{ $UserDetails->email }}">{{ $UserDetails->email }}</a></p>
                        @if($UserDetails->contactNum)
                            <p><i class="fa fa-phone"></i> <a href="tel:{{ $UserDetails->contactNum }}">{{ $UserDetails->contactNum }}</a></p>
                        @endif
                        @if($UserDetails->address)
                            <p><i class="fa fa-map-marker"></i> {{ $UserDetails->address }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-elegant text-center">
                        <img src="{{ asset('vikas_css/images/contact.gif') }}" alt="Contact" class="img-fluid" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="website-attribution text-center">
        <div class="container">
            <p>Developed and maintained by <a href="https://meetmytech.com" target="_blank" rel="noopener noreferrer">meetmytech.com</a></p>
        </div>
    </div>

    <script src="{{ asset('vikas_css/plugins/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vikas_css/plugins/js/popper.min.js') }}"></script>
    <script src="{{ asset('vikas_css/plugins/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/portfolio.js') }}" defer></script>

    @if(isset($UserDetails->tawk_js) && !empty($UserDetails->tawk_js))
        {!! $UserDetails->tawk_js !!}
    @endif
</main>
</body>
</html>
