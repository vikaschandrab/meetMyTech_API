<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Meet My tech">
    <meta name="keywords" content="meetMyTech, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>@yield('title', 'MeetMyTech')</title>

    <link href="{{ asset('dashboard_css/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
</head>

<body>
    <div class="wrapper">
        @include('Users.Partials.sidebar')

        <div class="main">
            @include('Users.Partials.navbar')

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('dashboard_css/js/app.js') }}"></script>

    {{-- Tawk.to Live Chat Integration --}}
    @php
        $siteSetting = App\Models\SiteSetting::where('user_id', Auth::id())->first();
    @endphp
    @if($siteSetting && $siteSetting->tawk_js)
        {!! $siteSetting->tawk_js !!}
    @endif

    @stack('scripts')
</body>

</html>
