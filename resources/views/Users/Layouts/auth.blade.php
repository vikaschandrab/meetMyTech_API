<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('description', 'Responsive Admin & Dashboard Template based on Bootstrap 5')">
    <meta name="author" content="MeetMyTech">
    <meta name="keywords" content="meetmytech, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💻</text></svg>">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90' fill='%232563eb'%3E&lt;/&gt;%3C/text%3E%3C/svg%3E" type="image/svg+xml">

    <!-- Page Title -->
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Stylesheets -->
    <link href="{{ asset('dashboard_css/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Additional page-specific styles -->
    @stack('styles')
</head>

<body class="@yield('body-class', 'd-flex align-items-center')">

    <!-- Main Content -->
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dashboard_css/js/app.js') }}"></script>

    <!-- Additional page-specific scripts -->
    @stack('scripts')
</body>

</html>
