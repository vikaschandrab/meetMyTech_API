/**
 * Experience Page JavaScript
 * Handles form interactions, validation, and delete confirmations
 */

// Success/Error message handling
window.ExperienceMessages = {
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
};

// Delete confirmation functionality
window.ExperienceDelete = {
    init: function() {
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    ExperienceDelete.confirmDelete(form);
                });
            });
        });
    },

    confirmDelete: function(form) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this work experience!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
};

// Initialize delete functionality
ExperienceDelete.init();
