<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Testing | MeetMyTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
        }
        
        .badge-design {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        
        .design-1 { background: linear-gradient(135deg, #2563eb, #f59e0b); }
        .design-2 { background: linear-gradient(135deg, #ffd700, #0a0a0a); }
        .design-3 { background: linear-gradient(135deg, #667eea, #764ba2); }
        
        .btn-design {
            margin: 0.5rem;
            border-radius: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="text-white mb-0">
                            <i class="fas fa-palette me-2"></i>
                            Design Session Testing
                        </h2>
                    </div>
                    <div class="card-body text-white">
                        <!-- Current Design Info -->
                        <div class="text-center mb-4">
                            <h4>Current Session Design</h4>
                            <span class="badge badge-design design-{{ $designInfo['design_number'] }}">
                                Design {{ $designInfo['design_number'] }}: {{ $designInfo['theme_info']['name'] }}
                            </span>
                            <p class="mt-2 text-light">{{ $designInfo['theme_info']['description'] }}</p>
                        </div>

                        <!-- Design Controls -->
                        <div class="row">
                            <div class="col-md-6">
                                <h5><i class="fas fa-cogs me-2"></i>Design Controls</h5>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('design.set', 1) }}" class="btn btn-outline-light btn-design">
                                        <i class="fas fa-sun me-2"></i>Set Light Theme (Design 1)
                                    </a>
                                    <a href="{{ route('design.set', 2) }}" class="btn btn-outline-light btn-design">
                                        <i class="fas fa-robot me-2"></i>Set Cyberpunk Theme (Design 2)
                                    </a>
                                    <a href="{{ route('design.set', 3) }}" class="btn btn-outline-light btn-design">
                                        <i class="fas fa-gem me-2"></i>Set Glassmorphism Theme (Design 3)
                                    </a>
                                    <a href="{{ route('design.reset') }}" class="btn btn-warning btn-design">
                                        <i class="fas fa-shuffle me-2"></i>Reset to Random
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5><i class="fas fa-navigation me-2"></i>Test Navigation</h5>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('home') }}" class="btn btn-primary btn-design" target="_blank">
                                        <i class="fas fa-home me-2"></i>Homepage
                                    </a>
                                    <a href="{{ route('contact') }}" class="btn btn-primary btn-design" target="_blank">
                                        <i class="fas fa-envelope me-2"></i>Contact Page
                                    </a>
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-design" target="_blank">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login Page
                                    </a>
                                    <a href="{{ route('forgot-password') }}" class="btn btn-primary btn-design" target="_blank">
                                        <i class="fas fa-key me-2"></i>Forgot Password
                                    </a>
                                    <a href="{{ route('home.all-blogs') }}" class="btn btn-primary btn-design" target="_blank">
                                        <i class="fas fa-blog me-2"></i>All Blogs
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div class="alert alert-info mt-4" role="alert">
                            <h6><i class="fas fa-info-circle me-2"></i>Testing Instructions:</h6>
                            <ul class="mb-0">
                                <li>Set a design using the controls above</li>
                                <li>Navigate to different pages using the test navigation buttons</li>
                                <li>All pages should now use the same design theme within your session</li>
                                <li>Open new tabs/windows - they'll maintain the same design</li>
                                <li>Clear cookies or use incognito to test random selection for new sessions</li>
                            </ul>
                        </div>

                        <!-- Design API Info -->
                        <div class="mt-4">
                            <h6><i class="fas fa-code me-2"></i>API Endpoints:</h6>
                            <ul class="list-unstyled">
                                <li><code>GET /design/info</code> - Get current design info (JSON)</li>
                                <li><code>GET /design/reset</code> - Reset to random design</li>
                                <li><code>GET /design/set/{1-3}</code> - Set specific design</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
