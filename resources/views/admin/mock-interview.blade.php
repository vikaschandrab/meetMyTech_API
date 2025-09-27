@extends('admin.layout')

@section('title', 'Mock Interview Management')
@section('page-title', 'Mock Interview Management')

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
        <h6 class="m-0 font-weight-bold"><i class="fas fa-comments me-2"></i>All Mock Interviews</h6>
    </div>
    <div class="card-body">
        @if($interviews->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Technology</th>
                            <th>Experience</th>
                            <th>Date & Time</th>
                            {{-- <th>Notes</th> --}}
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($interviews as $interview)
                            <tr>
                                <td>{{ $interview->name }}</td>
                                <td>{{ $interview->email }}</td>
                                <td>{{ $interview->technology }}</td>
                                <td>{{ $interview->experience }}</td>
                                <td>{{ $interview->date->format('M d, Y') }} {{ $interview->time }}</td>
                                {{-- <td>{{ Str::limit($interview->notes, 50) }}</td> --}}
                                {{-- <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.mock-interview-details', $interview->id) }}"
                                           class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-success"
                                                onclick="updateInterviewStatus({{ $interview->id }}, 'accepted')"
                                                title="Accept">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="updateInterviewStatus({{ $interview->id }}, 'rejected')"
                                                title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning"
                                                onclick="customReply({{ $interview->id }})"
                                                title="Custom Reply">
                                            <i class="fas fa-reply"></i>
                                        </button>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $interviews->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No mock interviews found</h5>
                <p class="text-muted">Interviews will appear here once candidates book them.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function updateInterviewStatus(id, status) {
    if(!confirm(`Are you sure you want to ${status} this interview?`)) return;

    fetch(`/admin/mock-interview/${id}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) location.reload();
        else alert('Failed to update status');
    })
    .catch(err => {
        console.error(err);
        alert('Error updating status');
    });
}

function customReply(id) {
    let message = prompt("Enter your custom reply:");
    if(!message) return;

    fetch(`/admin/mock-interview/${id}/reply`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) alert('Reply sent!');
        else alert('Failed to send reply');
    })
    .catch(err => {
        console.error(err);
        alert('Error sending reply');
    });
}
</script>
@endsection
