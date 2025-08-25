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
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-file-alt me-2"></i>Activity Logs</h6>
    </div>
    <div class="card-body">
        @if($logs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Description</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            @if($log->user && $log->user->userDetail && $log->user->userDetail->profile_image)
                                                <img src="{{ asset('storage/' . $log->user->userDetail->profile_image) }}"
                                                     alt="{{ $log->user->name }}" class="rounded-circle"
                                                     style="width: 30px; height: 30px; object-fit: cover;">
                                            @else
                                                <div class="avatar-title bg-secondary rounded-circle"
                                                     style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                                                    {{ $log->user ? substr($log->user->name, 0, 1) : 'S' }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0" style="font-size: 14px;">
                                                {{ $log->user->name ?? 'System' }}
                                            </h6>
                                            <small class="text-muted">
                                                {{ $log->user->email ?? 'system@meetmytech.com' }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $log->activity_name }}</span>
                                </td>
                                <td>
                                    @if($log->description)
                                        {{ Str::limit($log->description, 60) }}
                                    @else
                                        <span class="text-muted">No description</span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $log->created_at->format('M d, Y') }}</strong>
                                    </div>
                                    <small class="text-muted">{{ $log->created_at->format('h:i A') }}</small>
                                    <br>
                                    <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $logs->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No activity logs found</h5>
                <p class="text-muted">Activity logs will appear here as users interact with the system.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
// Add any JavaScript for log filtering or searching
document.addEventListener('DOMContentLoaded', function() {
    // Auto refresh logs every 30 seconds
    setInterval(function() {
        // Only refresh if user is actively viewing the page
        if (!document.hidden) {
            // You can add auto-refresh logic here if needed
        }
    }, 30000);
});
</script>
@endsection
