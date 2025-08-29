@extends('admin.layout')

@section('title', 'Blog Subscribers')
@section('page-title', 'Blog Subscribers Management')

@section('page-actions')
    <div class="btn-group">
        <div class="btn btn-outline-info">
            <i class="fas fa-users me-1"></i>{{ number_format($stats['total_subscribers']) }} Total
        </div>
        <div class="btn btn-outline-success">
            <i class="fas fa-bell me-1"></i>{{ number_format($stats['active_subscribers']) }} Active
        </div>
        <div class="btn btn-outline-warning">
            <i class="fas fa-bell-slash me-1"></i>{{ number_format($stats['unsubscribed']) }} Unsubscribed
        </div>
        <div class="btn btn-outline-primary">
            <i class="fas fa-calendar-day me-1"></i>{{ number_format($stats['today_subscriptions']) }} Today
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Subscribers
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($stats['total_subscribers']) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active Subscribers
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($stats['active_subscribers']) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bell fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Unsubscribed
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($stats['unsubscribed']) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bell-slash fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Today's Subscriptions
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($stats['today_subscriptions']) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscribers Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list me-2"></i>Blog Subscribers
                </h6>
            </div>
            <div class="card-body">
                @if($subscribers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Subscribed Date</th>
                                    <th>Unsubscribed Date</th>
                                    <th>IP Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscribers as $subscriber)
                                    <tr>
                                        <td>
                                            <strong>{{ $subscriber->email }}</strong>
                                        </td>
                                        <td>
                                            @if($subscriber->is_subscribed)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-bell me-1"></i>Subscribed
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-bell-slash me-1"></i>Unsubscribed
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($subscriber->subscribed_at)
                                                <small class="text-muted">
                                                    {{ $subscriber->subscribed_at->format('M d, Y H:i') }}
                                                </small>
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($subscriber->unsubscribed_at)
                                                <small class="text-muted">
                                                    {{ $subscriber->unsubscribed_at->format('M d, Y H:i') }}
                                                </small>
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $subscriber->ip_address ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @if($subscriber->is_subscribed)
                                                    <form action="{{ route('admin.unsubscribe-user', $subscriber->id) }}"
                                                          method="POST"
                                                          style="display: inline;"
                                                          onsubmit="return confirm('Are you sure you want to unsubscribe this user?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Unsubscribe">
                                                            <i class="fas fa-bell-slash"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.resubscribe-user', $subscriber->id) }}"
                                                          method="POST"
                                                          style="display: inline;"
                                                          onsubmit="return confirm('Are you sure you want to resubscribe this user?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Resubscribe">
                                                            <i class="fas fa-bell"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('admin.delete-subscriber', $subscriber->id) }}"
                                                      method="POST"
                                                      style="display: inline;"
                                                      onsubmit="return confirm('Are you sure you want to permanently delete this subscriber? This action cannot be undone.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $subscribers->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Subscribers Yet</h5>
                        <p class="text-muted">When users subscribe to blog notifications, they will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Flash message auto-hide
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                if (bootstrap && bootstrap.Alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                } else {
                    alert.style.display = 'none';
                }
            }, 5000);
        });
    });
</script>
@endsection
