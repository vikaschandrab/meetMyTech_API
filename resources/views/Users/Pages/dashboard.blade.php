@extends('Users.Layouts.app')

@section('title', 'Dashboard | ' . Auth::user()->name)

@push('styles')
<link href="{{ asset('css/pages/dashboard.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid p-0">
    {{-- Display Flash Messages --}}
    @if(session('message'))
        <div class="alert alert-{{ session('message_type', 'info') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Dashboard Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 d-inline align-middle">
                <strong>Welcome back,</strong> {{ Auth::user()->name }}
            </h1>
            <p class="text-muted mb-0">Here's what's happening with your profile</p>
        </div>
        <div>
            <span class="badge bg-primary">Profile {{ $stats['profile_completion'] ?? 0 }}% Complete</span>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Blogs</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="edit-3"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $stats['total_blogs'] ?? 0 }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Published articles</span>
                                </div>
                            </div>
                        </div>
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Experience</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-success">
                                            <i class="align-middle" data-feather="briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $stats['total_experiences'] ?? 0 }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Work experiences</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Education</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-warning">
                                            <i class="align-middle" data-feather="book-open"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $stats['total_education'] ?? 0 }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Education records</span>
                                </div>
                            </div>
                        </div>
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Activities</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-danger">
                                            <i class="align-middle" data-feather="activity"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $stats['total_activities'] ?? 0 }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Skills & activities</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Monthly Blog Chart --}}
        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Blog Activity</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Second Row --}}
    <div class="row">
        {{-- Recent Activity --}}
        <div class="col-12 col-md-6 col-xxl-4 d-flex order-1">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    @if(isset($stats['recent_activity']) && count($stats['recent_activity']) > 0)
                        @foreach($stats['recent_activity'] as $activity)
                            <div class="activity-item {{ $activity['color'] ?? 'primary' }}">
                                <div class="d-flex align-items-center">
                                    <i data-feather="{{ $activity['icon'] }}" class="feather-sm me-2 text-{{ $activity['color'] ?? 'primary' }}"></i>
                                    <div class="flex-grow-1">
                                        <p class="mb-1 fw-bold">{{ $activity['title'] }}</p>
                                        <small class="text-muted">{{ $activity['date']->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i data-feather="activity" class="feather-lg text-muted mb-2"></i>
                            <p class="text-muted">No recent activity</p>
                            <p class="text-muted small">Start by adding your profile information, work experience, or publishing a blog.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-12 col-md-6 col-xxl-4 d-flex order-2">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                            <i data-feather="plus" class="feather-sm me-1"></i>
                            Write New Blog
                        </a>
                        <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                            <i data-feather="user" class="feather-sm me-1"></i>
                            Update Profile
                        </a>
                        <a href="{{ route('experiance') }}" class="btn btn-outline-secondary">
                            <i data-feather="briefcase" class="feather-sm me-1"></i>
                            Add Experience
                        </a>
                        <a href="{{ route('education') }}" class="btn btn-outline-secondary">
                            <i data-feather="book-open" class="feather-sm me-1"></i>
                            Add Education
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profile Completion --}}
        <div class="col-12 col-md-12 col-xxl-4 d-flex order-3">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Completion</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-profile-completion"></canvas>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="mb-1">{{ $stats['profile_completion'] ?? 0 }}%</h3>
                            <p class="text-muted mb-0">Complete</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Blogs Table --}}
    @if(isset($stats['recent_blogs']) && count($stats['recent_blogs']) > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Blogs</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th class="d-none d-md-table-cell">Status</th>
                            <th class="d-none d-xl-table-cell">Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_blogs'] as $blog)
                        <tr>
                            <td>
                                <strong>{{ Str::limit($blog->title, 50) }}</strong>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <span class="badge bg-{{ $blog->status === 'published' ? 'success' : 'warning' }}">
                                    {{ ucfirst($blog->status) }}
                                </span>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                {{ $blog->created_at->format('M d, Y') }}
                            </td>
                            <td>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-sm btn-outline-primary">
                                    <i data-feather="eye" class="feather-sm"></i>
                                </a>
                                <a href="{{ route('blogs.edit', $blog->slug) }}" class="btn btn-sm btn-outline-secondary ms-1">
                                    <i data-feather="edit" class="feather-sm"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/pages/dashboard.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // Blog Activity Chart
    if (document.getElementById('chartjs-dashboard-line')) {
        const ctx = document.getElementById('chartjs-dashboard-line').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, 'rgba(13, 110, 253, 0.2)');
        gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(collect($stats['monthly_blog_stats'] ?? [])->pluck('month')) !!},
                datasets: [{
                    label: 'Blogs Published',
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#007bff',
                    data: {!! json_encode(collect($stats['monthly_blog_stats'] ?? [])->pluck('count')) !!}
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [3, 3]
                        },
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Profile Completion Chart
    if (document.getElementById('chartjs-profile-completion')) {
        const completion = {{ $stats['profile_completion'] ?? 0 }};
        
        new Chart(document.getElementById('chartjs-profile-completion'), {
            type: 'doughnut',
            data: {
                labels: ['Complete', 'Remaining'],
                datasets: [{
                    data: [completion, 100 - completion],
                    backgroundColor: ['#007bff', '#e9ecef'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
});
</script>

{{-- Session Messages --}}
@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endpush
