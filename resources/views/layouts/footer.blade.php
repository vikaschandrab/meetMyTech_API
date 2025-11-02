<!-- resources/views/layouts/footer.blade.php -->
<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="text-warning">
                    <i class="fas fa-code me-2"></i>MeetMyTech
                </h5>
                <p>
                    Empowering tech professionals to showcase their journey and share knowledge with the world.
                </p>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h6>Platform</h6>
                <ul class="list-unstyled">
                    <li><a href="#features" class="text-decoration-none">Features</a></li>
                    <li><a href="{{ route('home.all-blogs') }}" class="text-decoration-none">All Blogs</a></li>
                    <li><a href="{{ route('home.mock-interview') }}" class="text-decoration-none">Mock Interview</a></li>
                    <li><a href="{{ route('login') }}" class="text-decoration-none">Sign Up</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h6>Community</h6>
                <ul class="list-unstyled">
                    <li><a href="#community" class="text-decoration-none">Contributors</a></li>
                    <li><a href="#blogs" class="text-decoration-none">Featured Blogs</a></li>
                </ul>
            </div>
            <div class="col-lg-4 mb-4">
                <h6 class="text-warning mb-3">
                    <i class="fas fa-bell me-2"></i>Stay Updated with Our Latest Blogs
                </h6>
                <p class="text-light mb-3">
                    Get notified when we publish new tech insights, tutorials, and industry trends from our amazing community of developers.
                </p>
                <div class="d-flex gap-2">
                    <a href="{{ route('home.all-blogs') }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-blog me-1"></i>Browse Blogs
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-envelope me-1"></i>Subscribe
                    </a>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="small mb-0">
                    © {{ date('Y') }} MeetMyTech. Built with ❤️ for the tech community.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <small>
                    Developed and maintained by
                    <a href="https://meetmytech.com" class="text-warning text-decoration-none">meetmytech.com</a>
                </small>
            </div>
        </div>
    </div>
</footer>
