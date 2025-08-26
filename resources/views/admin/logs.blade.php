@extends('admin.layout')

@section('title', 'Activity Logs')
@section('page-title', 'System Activity Logs')

@section('page-actions')
    <div class="btn-group">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
        </a>
    </div>
@endsection

@section('content')
<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-filter me-2"></i>Filter Logs</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.logs') }}" class="row g-3">
            <div class="col-md-4">
                <label for="activity" class="form-label">Activity Type</label>
                <select name="activity" id="activity" class="form-select">
                    <option value="all" {{ $activityFilter === 'all' ? 'selected' : '' }}>All Activities</option>
                    @foreach($activities as $activity)
                        <option value="{{ $activity }}" {{ $activityFilter === $activity ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $activity)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="date" class="form-label">Date</label>
                <select name="date" id="date" class="form-select">
                    <option value="all" {{ $dateFilter === 'all' ? 'selected' : '' }}>All Dates</option>
                    @foreach($availableDates as $date)
                        <option value="{{ $date }}" {{ $dateFilter === $date ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                    <a href="{{ route('admin.logs') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-refresh me-1"></i>Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Total Activities</h6>
                        <h4 class="mb-0">{{ count($activities) }}</h4>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-list fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Total Logs</h6>
                        <h4 class="mb-0">{{ count($customLogs) }}</h4>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-file-alt fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Today's Logs</h6>
                        <h4 class="mb-0">{{ collect($customLogs)->where('date', now()->format('Y-m-d'))->count() }}</h4>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-calendar-day fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Available Dates</h6>
                        <h4 class="mb-0">{{ count($availableDates) }}</h4>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-calendar fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grouped Logs by Activity -->
@if($activityFilter === 'all' && count($groupedLogs) > 0)
<div class="row mb-4">
    @foreach($groupedLogs as $activity => $logs)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-{{ $logs[0]['activity_icon'] ?? 'file-alt' }} me-2"></i>
                        {{ ucfirst(str_replace('_', ' ', $activity)) }}
                        <span class="badge bg-primary ms-2">{{ count($logs) }}</span>
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-2">Recent entries:</p>
                    @foreach(array_slice($logs, 0, 3) as $log)
                        <div class="mb-2 pb-2 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <small class="text-truncate flex-grow-1 me-2">
                                    {{ Str::limit($log['message'], 50) }}
                                </small>
                                <span class="badge bg-{{ $log['level_color'] ?? 'light' }} text-xs">
                                    {{ $log['level'] }}
                                </span>
                            </div>
                            @if($log['timestamp'])
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($log['timestamp'])->diffForHumans() }}
                                </small>
                            @endif
                        </div>
                    @endforeach
                    @if(count($logs) > 3)
                        <small class="text-muted">... and {{ count($logs) - 3 }} more entries</small>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.logs', ['activity' => $activity]) }}" class="btn btn-sm btn-outline-primary">
                        View All {{ ucfirst($activity) }} Logs
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-file-alt me-2"></i>Activity Logs</h6>
    </div>
    <div class="card-body">
<!-- Detailed Logs Table -->
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-file-alt me-2"></i>
            @if($activityFilter !== 'all')
                {{ ucfirst(str_replace('_', ' ', $activityFilter)) }} Logs
            @else
                All Activity Logs
            @endif
            @if($dateFilter !== 'all')
                - {{ \Carbon\Carbon::parse($dateFilter)->format('F j, Y') }}
            @endif
        </h6>
    </div>
    <div class="card-body">
        @if(count($paginatedLogs) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="15%">Activity</th>
                            <th width="10%">Level</th>
                            <th width="45%">Message</th>
                            <th width="15%">Date</th>
                            <th width="15%">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paginatedLogs as $log)
                            <tr>
                                <td>
                                    <span class="badge bg-{{ $log['activity_color'] ?? 'light' }}">
                                        <i class="fas fa-{{ $log['activity_icon'] ?? 'file-alt' }} me-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', $log['activity'])) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $log['level_color'] ?? 'light' }}">
                                        {{ strtoupper($log['level']) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="log-message" title="{{ $log['message'] }}">
                                        {{ Str::limit($log['message'], 80) }}
                                    </div>
                                    <small class="text-muted">{{ $log['filename'] }}</small>
                                </td>
                                <td>
                                    @if($log['timestamp'])
                                        <strong>{{ \Carbon\Carbon::parse($log['timestamp'])->format('M d, Y') }}</strong>
                                    @else
                                        <strong>{{ \Carbon\Carbon::parse($log['date'])->format('M d, Y') }}</strong>
                                    @endif
                                </td>
                                <td>
                                    @if($log['timestamp'])
                                        <div>{{ \Carbon\Carbon::parse($log['timestamp'])->format('h:i:s A') }}</div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($log['timestamp'])->diffForHumans() }}</small>
                                    @else
                                        <small class="text-muted">Time not available</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Simple Pagination -->
            @if(count($customLogs) > 50)
                <div class="d-flex justify-content-center mt-3">
                    @php
                        $currentPage = request()->get('page', 1);
                        $totalPages = ceil(count($customLogs) / 50);
                    @endphp
                    
                    <nav aria-label="Log pagination">
                        <ul class="pagination">
                            @if($currentPage > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}">Previous</a>
                                </li>
                            @endif
                            
                            @for($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++)
                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                    <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            @if($currentPage < $totalPages)
                                <li class="page-item">
                                    <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}">Next</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        @else
            <div class="text-center py-4">
                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No logs found</h5>
                @if($activityFilter !== 'all' || $dateFilter !== 'all')
                    <p class="text-muted">No logs match your current filters. Try adjusting the filters above.</p>
                    <a href="{{ route('admin.logs') }}" class="btn btn-outline-primary">View All Logs</a>
                @else
                    <p class="text-muted">Activity logs will appear here as the system processes activities.</p>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Database Logs Section (for comparison) -->
@if(isset($databaseLogs) && $databaseLogs->count() > 0 && $activityFilter === 'all')
<div class="card mt-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-database me-2"></i>Database Activity Logs (Recent 20)
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Description</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($databaseLogs as $log)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        @if($log->user && $log->user->userDetail && $log->user->userDetail->profile_image)
                                            <img src="{{ asset('storage/' . $log->user->userDetail->profile_image) }}"
                                                 alt="{{ $log->user->name }}" class="rounded-circle"
                                                 style="width: 24px; height: 24px; object-fit: cover;">
                                        @else
                                            <div class="avatar-title bg-secondary rounded-circle"
                                                 style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 10px;">
                                                {{ $log->user ? substr($log->user->name, 0, 1) : 'S' }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <small class="fw-bold">{{ $log->user->name ?? 'System' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $log->activity_name }}</span>
                            </td>
                            <td>
                                <small>{{ Str::limit($log->description ?? 'No description', 50) }}</small>
                            </td>
                            <td>
                                <small>
                                    {{ $log->created_at->format('M d, h:i A') }}
                                    <br>
                                    <span class="text-muted">{{ $log->created_at->diffForHumans() }}</span>
                                </small>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
// Add any JavaScript for log filtering or searching
document.addEventListener('DOMContentLoaded', function() {
    // Auto refresh logs every 60 seconds
    setInterval(function() {
        // Only refresh if user is actively viewing the page
        if (!document.hidden) {
            // You can add auto-refresh logic here if needed
        }
    }, 60000);
    
    // Add tooltips to log messages
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Helper functions for styling (these should be moved to controller ideally)
function getActivityIcon(activity) {
    const icons = {
        'authentication': 'user-shield',
        'blog': 'blog',
        'dashboard': 'tachometer-alt',
        'database': 'database',
        'profile': 'user-edit',
        'security': 'shield-alt',
        'site_settings': 'cogs',
        'default': 'file-alt'
    };
    return icons[activity] || icons['default'];
}

function getActivityColor(activity) {
    const colors = {
        'authentication': 'primary',
        'blog': 'success',
        'dashboard': 'info',
        'database': 'warning',
        'profile': 'secondary',
        'security': 'danger',
        'site_settings': 'dark',
        'default': 'light'
    };
    return colors[activity] || colors['default'];
}

function getLevelColor(level) {
    const colors = {
        'debug': 'secondary',
        'info': 'info',
        'notice': 'primary',
        'warning': 'warning',
        'error': 'danger',
        'critical': 'danger',
        'alert': 'danger',
        'emergency': 'danger',
        'default': 'light'
    };
    return colors[level.toLowerCase()] || colors['default'];
}
</script>

<style>
.log-message {
    word-break: break-word;
    line-height: 1.4;
}

.card-header h6 {
    font-weight: 600;
}

.badge {
    font-size: 0.75em;
}

.avatar-title {
    font-weight: 600;
}

.table th {
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
}

.pagination .page-link {
    color: #007bff;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.stats-card {
    transition: transform 0.2s;
}

.stats-card:hover {
    transform: translateY(-2px);
}
</style>
@endsection
