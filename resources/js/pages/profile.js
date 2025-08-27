/**
 * Profile Page JavaScript
 * Handles image preview, form interactions, and messaging
 */

// Profile functionality namespace
window.ProfileManager = {
    // Image preview functionality
    previewImage: function(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('profilePreview');
            if (preview) {
                preview.src = reader.result;
                preview.style.display = 'block';
            }
        }
        if (event.target.files && event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    },

    // Initialize profile functionality
    init: function() {
        // Add event listeners for file input
        const fileInput = document.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.addEventListener('change', this.previewImage);
        }

        // Initialize tooltips if Bootstrap is available
        if (typeof bootstrap !== 'undefined') {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    },

    // Message handling
    messages: {
        showSuccess: function(message) {
            Swal.fire({
                title: 'Success!',
                text: message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        },

        showError: function(message) {
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        },

        showValidationError: function(message) {
            Swal.fire({
                title: 'Validation Error!',
                text: message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    ProfileManager.init();
});

// Make previewImage globally available for legacy support
window.previewImage = ProfileManager.previewImage;
