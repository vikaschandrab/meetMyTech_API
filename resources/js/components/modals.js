/**
 * Common Modal Functionality
 * Handles form validation, submission, and common modal interactions
 */

window.ModalManager = {
    // Form validation
    validateForm: function(formElement) {
        const requiredFields = formElement.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                this.showFieldError(field, 'This field is required');
                isValid = false;
            } else {
                this.clearFieldError(field);
            }
        });
        
        return isValid;
    },

    // Show field error
    showFieldError: function(field, message) {
        this.clearFieldError(field);
        field.classList.add('is-invalid');
        
        const feedback = document.createElement('div');
        feedback.className = 'invalid-feedback';
        feedback.textContent = message;
        field.parentNode.appendChild(feedback);
    },

    // Clear field error
    clearFieldError: function(field) {
        field.classList.remove('is-invalid');
        const feedback = field.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
            feedback.remove();
        }
    },

    // Loading state management
    setLoading: function(button, loading = true) {
        if (loading) {
            button.classList.add('loading');
            button.disabled = true;
        } else {
            button.classList.remove('loading');
            button.disabled = false;
        }
    },

    // Reset modal form
    resetForm: function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            const form = modal.querySelector('form');
            if (form) {
                form.reset();
                // Clear all validation states
                const invalidFields = form.querySelectorAll('.is-invalid');
                invalidFields.forEach(field => this.clearFieldError(field));
            }
        }
    },

    // Initialize modal functionality
    init: function() {
        // Handle modal reset on close
        document.addEventListener('hidden.bs.modal', function(event) {
            const modalId = event.target.id;
            if (modalId) {
                ModalManager.resetForm(modalId);
            }
        });

        // Handle form submissions with validation
        document.addEventListener('submit', function(event) {
            const form = event.target;
            if (form.closest('.modal')) {
                const submitButton = form.querySelector('button[type="submit"]');
                
                if (!ModalManager.validateForm(form)) {
                    event.preventDefault();
                    return false;
                }
                
                if (submitButton) {
                    ModalManager.setLoading(submitButton, true);
                }
            }
        });
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    ModalManager.init();
});
