@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Users</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['total_users'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Blogs</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['total_blogs'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-blog fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Recent Activities</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $stats['user_activities']->count() ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">System Status</div>
                        <div class="h5 mb-0 font-weight-bold">Active</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-server fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-users me-2"></i>Recent Users</h6>
            </div>
            <div class="card-body">
                @if(isset($stats['recent_users']) && $stats['recent_users']->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($stats['recent_users'] as $user)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <div>
                                    <span class="badge bg-{{ $user->user_type === 'admin' ? 'danger' : 'primary' }}">
                                        {{ ucfirst($user->user_type) }}
                                    </span>
                                    <small class="text-muted d-block">{{ $user->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary btn-sm">View All Users</a>
                    </div>
                @else
                    <p class="text-muted text-center">No users found</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-blog me-2"></i>Recent Blogs</h6>
            </div>
            <div class="card-body">
                @if(isset($stats['recent_blogs']) && $stats['recent_blogs']->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($stats['recent_blogs'] as $blog)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ Str::limit($blog->title, 40) }}</h6>
                                    <small>{{ $blog->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                                <small class="text-muted">
                                    Status: <span class="badge bg-{{ $blog->status === 'active' ? 'success' : 'warning' }}">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </small>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.blogs') }}" class="btn btn-primary btn-sm">View All Blogs</a>
                    </div>
                @else
                    <p class="text-muted text-center">No blogs found</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-line me-2"></i>Recent Activity</h6>
            </div>
            <div class="card-body">
                @if(isset($stats['user_activities']) && $stats['user_activities']->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Activity</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['user_activities']->take(10) as $activity)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <div class="avatar-title bg-primary rounded-circle">
                                                        {{ substr($activity->user->name ?? 'Unknown', 0, 1) }}
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $activity->user->name ?? 'Unknown User' }}</h6>
                                                    <small class="text-muted">{{ $activity->user->email ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $activity->activity_name }}</td>
                                        <td>
                                            <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('admin.logs') }}" class="btn btn-primary btn-sm">View All Logs</a>
                    </div>
                @else
                    <p class="text-muted text-center">No recent activities</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
