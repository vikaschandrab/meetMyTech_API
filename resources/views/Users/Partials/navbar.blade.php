{{-- Top Navigation Bar --}}
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>
    
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    @if(Auth::user()->profilePic)
                        <img src="{{ asset('storage/' . Auth::user()->profilePic) }}" 
                             class="avatar img-fluid rounded me-1" 
                             alt="{{ Auth::user()->name }}" />
                    @else
                        <img src="{{ asset('dashboard_css/img/avatars/avatar.jpg') }}" 
                             class="avatar img-fluid rounded me-1" 
                             alt="{{ Auth::user()->name }}" />
                    @endif
                    <span class="text-dark">{{ Auth::user()->name }}</span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('site-settings') }}">
                        <i class="align-middle me-1" data-feather="settings"></i> Site Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="align-middle me-1" data-feather="log-out"></i>Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
