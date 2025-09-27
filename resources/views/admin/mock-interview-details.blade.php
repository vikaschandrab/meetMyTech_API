@extends('admin.layout')

@section('title', 'Mock Interview Details')
@section('page-title', 'Mock Interview Details')

@section('page-actions')
    <div class="btn-group">
        <a href="{{ route('admin.mock-interview') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Back to List
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-comments me-2"></i>Interview Details</h6>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $interview->name }}</p>
        <p><strong>Email:</strong> {{ $interview->email }}</p>
        <p><strong>Technology:</strong> {{ $interview->technology }}</p>
        <p><strong>Experience:</strong> {{ $interview->experience }}</p>
        <p><strong>Date & Time:</strong>{{ $interview->date->format('M d, Y') }} {{ $interview->time }}</p>
        <p><strong>Notes:</strong> {{ $interview->notes ?? 'N/A' }}</p>

        {{-- <div class="mt-3">
            <button class="btn btn-success" onclick="updateInterviewStatus({{ $interview->id }}, 'accepted')">Accept</button>
            <button class="btn btn-danger" onclick="updateInterviewStatus({{ $interview->id }}, 'rejected')">Reject</button>
            <button class="btn btn-warning" onclick="customReply({{ $interview->id }})">Custom Reply</button>
        </div> --}}
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
    });
}
</script>
@endsection
