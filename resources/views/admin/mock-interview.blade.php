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
                            <th>Notes</th>
                            <th>Actions</th>
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
                                <td>{{ Str::limit($interview->notes, 50) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.mock-interview-details', $interview->id) }}"
                                        class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($interview->status === 'pending')
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

                                            <button class="btn btn-sm btn-outline-primary"
                                                    onclick="showAdminNotesModal({{ $interview->id }})"
                                                    title="Mark as Completed">
                                                <i class="fas fa-check-double"></i>
                                            </button>

                                            <button class="btn btn-sm btn-outline-warning"
                                                    onclick="customReply({{ $interview->id }})"
                                                    title="Custom Reply">
                                                <i class="fas fa-reply"></i>
                                            </button>

                                        @elseif($interview->status === 'accepted')
                                            <span class="btn btn-sm btn-outline-primary" title="Accepted"> <i class="fas fa-check"></i></span>

                                        @elseif($interview->status === 'rejected')
                                            <span class="btn btn-sm btn-outline-primary" title="Rejected"> <i class="fas fa-times"></i></span>

                                        @elseif($interview->status === 'completed')
                                            <span class="btn btn-sm btn-outline-primary" title="Completed"> <i class="fas fa-check-double"></i></span>
                                        @endif
                                    </div>
                                </td>
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

    const url = `{{ url('admin/mock-interview') }}/` + id + '/status';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status })
    })
    .then(async res => {
        const text = await res.text(); // get raw text first
        try {
            const data = JSON.parse(text); // try parse as JSON
            if(data.success) {
                alert('Status updated successfully!');
                location.reload();
            } else {
                alert(data.message || 'Failed to update status');
            }
        } catch (err) {
            console.error('Response is not JSON:', text);
            alert(`Error updating status. Server returned HTML or invalid JSON (Status ${res.status})`);
        }
    })
    .catch(err => {
        console.error(err);
        alert('Network or server error while updating status');
    });
}

function customReply(id) {
    let message = prompt("Enter your custom reply:");
    if(!message) return;

    const url = `{{ url('admin/mock-interview') }}/` + id + '/reply';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message })
    })
    .then(async res => {
        const text = await res.text();
        try {
            const data = JSON.parse(text);
            if(data.success) alert('Reply sent successfully!');
            else alert(data.message || 'Failed to send reply');
        } catch (err) {
            console.error('Response is not JSON:', text);
            alert(`Error sending reply. Server returned HTML or invalid JSON (Status ${res.status})`);
        }
    })
    .catch(err => {
        console.error(err);
        alert('Network or server error while sending reply');
    });
}

function showAdminNotesModal(id) {
    document.getElementById('interviewId').value = id;
    $('#adminNotesModal').modal('show');
}

function submitAdminNotes() {
    const interviewId = document.getElementById('interviewId').value;
    const form = document.getElementById('adminNotesForm');

    // Validate all required fields
    const requiredFields = form.querySelectorAll('[required]');
    for (let field of requiredFields) {
        if (!field.value.trim()) {
            alert('Please fill in all required fields');
            field.focus();
            return;
        }
    }

    // Compile all notes into a formatted string
    const formData = new FormData(form);
    let adminNotes = '';

    // Build structured notes
    adminNotes += '# Technical Skills & Knowledge\n';
    adminNotes += formData.get('technical_skills') + '\n\n';

    adminNotes += '# Communication Skills\n';
    adminNotes += formData.get('communication_skills') + '\n\n';

    adminNotes += '# Problem-Solving Approach\n';
    adminNotes += formData.get('problem_solving') + '\n\n';

    adminNotes += '# Best Practices & Code Quality\n';
    adminNotes += formData.get('best_practices') + '\n\n';

    adminNotes += '# Areas for Improvement\n';
    adminNotes += formData.get('improvements') + '\n\n';

    if (formData.get('additional_comments')) {
        adminNotes += '# Additional Comments\n';
        adminNotes += formData.get('additional_comments');
    }

    // Close modal and submit
    $('#adminNotesModal').modal('hide');

    // Update interview status with admin notes
    updateInterviewStatus(interviewId, 'completed', adminNotes);
}

function updateInterviewStatus(id, status, adminNotes = null) {
    if(!adminNotes && !confirm(`Are you sure you want to ${status} this interview?`)) return;

    const url = `{{ url('admin/mock-interview') }}/` + id + '/status';
    const data = { status };

    if (adminNotes) {
        data.admin_notes = adminNotes;
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(async res => {
        const text = await res.text();
        try {
            const data = JSON.parse(text);
            if(data.success) {
                alert('Status updated successfully!');
                location.reload();
            } else {
                alert(data.message || 'Failed to update status');
            }
        } catch (err) {
            console.error('Response is not JSON:', text);
            alert(`Error updating status. Server returned HTML or invalid JSON (Status ${res.status})`);
        }
    })
    .catch(err => {
        console.error(err);
        alert('Network or server error while updating status');
    });
}
</script>

<!-- Admin Notes Modal -->
<div class="modal fade" id="adminNotesModal" tabindex="-1" aria-labelledby="adminNotesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminNotesModalLabel">Interview Assessment Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminNotesForm">
                    <input type="hidden" id="interviewId">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Technical Skills & Knowledge</label>
                            <textarea class="form-control" name="technical_skills" rows="3" required
                                placeholder="Evaluate candidate's technical knowledge, problem-solving abilities, and understanding of core concepts"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Communication Skills</label>
                            <textarea class="form-control" name="communication_skills" rows="3" required
                                placeholder="Assess clarity of expression, ability to explain complex concepts, and professional communication"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Problem-Solving Approach</label>
                            <textarea class="form-control" name="problem_solving" rows="3" required
                                placeholder="Evaluate analytical skills, solution design approach, and consideration of edge cases"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Best Practices & Code Quality</label>
                            <textarea class="form-control" name="best_practices" rows="3" required
                                placeholder="Comment on coding standards, architecture knowledge, and best practices awareness"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Areas for Improvement</label>
                            <textarea class="form-control" name="improvements" rows="3" required
                                placeholder="Suggest specific areas where the candidate can improve"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold">Additional Comments</label>
                            <textarea class="form-control" name="additional_comments" rows="3"
                                placeholder="Any other relevant observations or recommendations"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitAdminNotes()">Submit Assessment</button>
            </div>
        </div>
    </div>
</div>
@endsection
