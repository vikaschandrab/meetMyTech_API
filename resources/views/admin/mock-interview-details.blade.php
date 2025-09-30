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
        <p><strong>Status:</strong> {{ ucfirst($interview->status) }}</p>
        @if($interview->meeting_link)
            <p><strong>Meeting link:</strong> <a href="{{ $interview->meeting_link }}" target="_blank">Join</a></p>
        @endif
    </div>
</div>

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
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Technical Skills & Knowledge</label>
                            <textarea class="form-control" name="technical_skills" rows="3" required placeholder="Evaluate candidate's technical knowledge, problem-solving abilities, and understanding of core concepts"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Communication Skills</label>
                            <textarea class="form-control" name="communication_skills" rows="3" required placeholder="Assess clarity of expression, ability to explain complex concepts, and professional communication"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Problem-Solving Approach</label>
                            <textarea class="form-control" name="problem_solving" rows="3" required placeholder="Evaluate analytical skills, solution design approach, and consideration of edge cases"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Best Practices & Code Quality</label>
                            <textarea class="form-control" name="best_practices" rows="3" required placeholder="Comment on coding standards, architecture knowledge, and best practices awareness"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Areas for Improvement</label>
                            <textarea class="form-control" name="improvements" rows="3" required placeholder="Suggest specific areas where the candidate can improve"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold">Additional Comments</label>
                            <textarea class="form-control" name="additional_comments" rows="3" placeholder="Any other relevant observations or recommendations"></textarea>
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

@section('scripts')
<script>
function showAdminNotesModal() {
    $('#adminNotesModal').modal('show');
}

function showEditNotesModal() {
    // Parse existing notes into the form
    const notes = @json($interview->admin_notes ?? '');
    const form = document.getElementById('adminNotesForm');

    // Try to parse the sections from the markdown-like format
    const sections = notes.split('\n# ').filter(Boolean);
    sections.forEach(section => {
        const [title, ...content] = section.split('\n');
        const fieldName = title.toLowerCase().replace(/ & /g, '_').replace(/[ -]/g, '_');
        const textarea = form.querySelector(`[name="${fieldName}"]`);
        if (textarea) {
            textarea.value = content.join('\n').trim();
        }
    });

    $('#adminNotesModal').modal('show');
}

function submitAdminNotes() {
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

    // Close modal
    $('#adminNotesModal').modal('hide');

    // Submit the assessment
    fetch('/admin/mock-interview/{{ $interview->id }}/status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            status: 'completed',
            admin_notes: adminNotes
        })
    })
    .then(async response => {
        const text = await response.text();
        try {
            const data = JSON.parse(text);
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Failed to update assessment');
            }
        } catch (err) {
            console.error('Response is not JSON:', text);
            alert('Error updating assessment. Server returned invalid response.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Network or server error while updating assessment');
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
