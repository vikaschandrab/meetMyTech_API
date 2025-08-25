{{-- Sidebar Navigation --}}
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <span class="align-middle">
                <i class="fas fa-code me-2"></i>MeetMyTech
            </span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="menu"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('profile') }}">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('aboutMe') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('aboutMe') }}">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">About Me</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('myActivities') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('myActivities') }}">
                    <i class="align-middle" data-feather="activity"></i>
                    <span class="align-middle">What I do</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('education') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('education') }}">
                    <i class="align-middle" data-feather="book-open"></i>
                    <span class="align-middle">Education</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('experiance') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('experiance') }}">
                    <i class="align-middle" data-feather="monitor"></i>
                    <span class="align-middle">Experience</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('blogs.index') }}">
                    <i class="align-middle" data-feather="edit-3"></i>
                    <span class="align-middle">My Blogs</span>
                </a>
            </li>

            <li class="sidebar-header">
                Settings
            </li>

            <li class="sidebar-item {{ request()->routeIs('site-settings') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('site-settings') }}">
                    <i class="align-middle" data-feather="settings"></i>
                    <span class="align-middle">Site Settings</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
