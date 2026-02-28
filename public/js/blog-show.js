document.addEventListener('DOMContentLoaded', function() {
    const blogPage = document.getElementById('blogPage');
    const subscribeUrl = blogPage ? blogPage.dataset.subscribeUrl : null;

    // Character count for comment textarea (both original and modal)
    const messageTextareas = ['message', 'modal_message'];
    const charCounts = ['charCount', 'modalCharCount'];

    messageTextareas.forEach((textareaId, index) => {
        const textarea = document.getElementById(textareaId);
        const charCount = document.getElementById(charCounts[index]);

        if (textarea && charCount) {
            function updateCharCount() {
                const currentLength = textarea.value.length;
                charCount.textContent = currentLength + '/1000';

                if (currentLength > 900) {
                    charCount.classList.add('text-danger');
                    charCount.classList.remove('text-warning', 'text-muted');
                } else if (currentLength > 800) {
                    charCount.classList.add('text-warning');
                    charCount.classList.remove('text-danger', 'text-muted');
                } else {
                    charCount.classList.add('text-muted');
                    charCount.classList.remove('text-danger', 'text-warning');
                }
            }

            textarea.addEventListener('input', updateCharCount);
            textarea.addEventListener('keyup', updateCharCount);
            textarea.addEventListener('paste', function() {
                setTimeout(updateCharCount, 10);
            });

            updateCharCount();
        }
    });

    // Form submission handling for modal comment form
    const commentForm = document.getElementById('commentForm');
    const modalSubmitBtn = document.getElementById('modalSubmitBtn');

    if (commentForm && modalSubmitBtn) {
        commentForm.addEventListener('submit', function(e) {
            const userName = document.getElementById('modal_user_name').value.trim();
            const message = document.getElementById('modal_message').value.trim();

            if (!userName || !message) {
                e.preventDefault();
                alert('Please fill in both name and comment fields.');
                return false;
            }

            if (message.length > 1000) {
                e.preventDefault();
                alert('Comment is too long. Please keep it under 1000 characters.');
                return false;
            }

            modalSubmitBtn.disabled = true;
            modalSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Posting...';
        });
    }

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            if (window.bootstrap && bootstrap.Alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            } else {
                alert.style.display = 'none';
            }
        }, 5000);
    });

    // Fix for input visibility - ensure text is visible
    const formInputs = document.querySelectorAll('.comment-form input, .comment-form textarea, .subscription-form input');
    formInputs.forEach(function(input) {
        input.style.backgroundColor = '#fff';
        input.style.color = '#2c3e50';
        input.style.webkitTextFillColor = '#2c3e50';

        input.addEventListener('focus', function() {
            this.style.backgroundColor = '#fff';
            this.style.color = '#2c3e50';
            this.style.webkitTextFillColor = '#2c3e50';
        });

        input.addEventListener('input', function() {
            this.style.backgroundColor = '#fff';
            this.style.color = '#2c3e50';
            this.style.webkitTextFillColor = '#2c3e50';
        });
    });

    // Ensure form labels are visible
    const formLabels = document.querySelectorAll('.subscription-form .form-label, .comment-form .form-label');
    formLabels.forEach(function(label) {
        label.style.color = '#2c3e50';
        label.style.fontWeight = '600';
        label.style.display = 'block';
    });

    // Modal Subscription Form Handler
    const modalSubscriptionForm = document.getElementById('modalSubscriptionForm');
    const modalSubscribeBtn = document.getElementById('modalSubscribeBtn');
    const modalSubscriptionMessage = document.getElementById('modalSubscriptionMessage');

    if (modalSubscriptionForm) {
        modalSubscriptionForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            if (!subscribeUrl) {
                console.error('Subscribe URL not found');
                return;
            }

            modalSubscriptionMessage.style.display = 'none';
            modalSubscribeBtn.disabled = true;
            modalSubscribeBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Subscribing...';

            document.getElementById('modal_subscription_email').classList.remove('is-invalid');
            document.getElementById('modalRecaptchaError').textContent = '';

            try {
                const response = await fetch(subscribeUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    modalSubscriptionMessage.className = 'alert alert-success';
                    modalSubscriptionMessage.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>
                        ${data.message}
                    `;
                    modalSubscriptionMessage.style.display = 'block';

                    modalSubscriptionForm.reset();

                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }

                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('subscriptionModal'));
                        modal.hide();
                    }, 3000);
                } else {
                    modalSubscriptionMessage.className = 'alert alert-danger';
                    modalSubscriptionMessage.innerHTML = `
                        <i class="fas fa-exclamation-circle me-2"></i>
                        ${data.message || 'An error occurred. Please try again.'}
                    `;
                    modalSubscriptionMessage.style.display = 'block';

                    if (data.errors) {
                        if (data.errors.email) {
                            document.getElementById('modal_subscription_email').classList.add('is-invalid');
                            const feedback = document.querySelector('#modal_subscription_email + .invalid-feedback');
                            if (feedback) {
                                feedback.textContent = data.errors.email[0];
                            }
                        }
                        if (data.errors['g-recaptcha-response']) {
                            document.getElementById('modalRecaptchaError').textContent = data.errors['g-recaptcha-response'][0];
                        }
                    }
                }
            } catch (error) {
                console.error('Subscription error:', error);
                modalSubscriptionMessage.className = 'alert alert-danger';
                modalSubscriptionMessage.innerHTML = `
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Network error. Please check your connection and try again.
                `;
                modalSubscriptionMessage.style.display = 'block';
            } finally {
                modalSubscribeBtn.disabled = false;
                modalSubscribeBtn.innerHTML = '<i class="fas fa-bell me-2"></i><span class="btn-text">Subscribe Now</span>';

                setTimeout(() => {
                    if (modalSubscriptionMessage.style.display !== 'none') {
                        modalSubscriptionMessage.style.display = 'none';
                    }
                }, 8000);
            }
        });
    }

    document.getElementById('commentModal').addEventListener('hidden.bs.modal', function() {
        const form = this.querySelector('form');
        if (form) form.reset();

        if (modalSubmitBtn) {
            modalSubmitBtn.disabled = false;
            modalSubmitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Post Comment';
        }

        const charCount = document.getElementById('modalCharCount');
        if (charCount) charCount.textContent = '0/1000';
    });

    document.getElementById('subscriptionModal').addEventListener('hidden.bs.modal', function() {
        const form = this.querySelector('form');
        if (form) form.reset();

        if (modalSubscribeBtn) {
            modalSubscribeBtn.disabled = false;
            modalSubscribeBtn.innerHTML = '<i class="fas fa-bell me-2"></i><span class="btn-text">Subscribe Now</span>';
        }

        if (modalSubscriptionMessage) {
            modalSubscriptionMessage.style.display = 'none';
        }

        document.getElementById('modal_subscription_email').classList.remove('is-invalid');
        document.getElementById('modalRecaptchaError').textContent = '';
    });
});
