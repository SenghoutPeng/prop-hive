/**
 * PropHive - Authentication JavaScript
 * Handles login and registration functionality
 */

class AuthApp {
    constructor() {
        this.init();
    }

    init() {
        this.setupFormValidation();
        this.setupPasswordToggle();
        this.setupRememberMe();
        this.setupAnimations();
    }

    setupFormValidation() {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });

            // Real-time validation
            form.querySelectorAll('input, textarea').forEach(field => {
                field.addEventListener('blur', () => {
                    this.validateField(field);
                });

                field.addEventListener('input', () => {
                    this.removeFieldError(field);
                });
            });
        });
    }

    validateForm(form) {
        let isValid = true;
        const fields = form.querySelectorAll('input[required], textarea[required]');
        
        fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        return isValid;
    }

    validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        // Remove existing error
        this.removeFieldError(field);

        // Validation rules
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'This field is required.';
        } else if (field.type === 'email' && value && !this.isValidEmail(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address.';
        } else if (field.type === 'password' && value && value.length < 6) {
            isValid = false;
            errorMessage = 'Password must be at least 6 characters long.';
        } else if (field.name === 'password_confirmation' && value) {
            const password = form.querySelector('input[name="password"]');
            if (password && value !== password.value) {
                isValid = false;
                errorMessage = 'Passwords do not match.';
            }
        } else if (field.name === 'phone' && value && !this.isValidPhone(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number.';
        }

        if (!isValid) {
            this.showFieldError(field, errorMessage);
        }

        return isValid;
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    isValidPhone(phone) {
        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
        return phoneRegex.test(phone.replace(/[\s\-\(\)]/g, ''));
    }

    showFieldError(field, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.textContent = message;
        field.classList.add('error');
        field.parentNode.appendChild(errorDiv);
    }

    removeFieldError(field) {
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
        field.classList.remove('error');
    }

    setupPasswordToggle() {
        const passwordFields = document.querySelectorAll('input[type="password"]');
        
        passwordFields.forEach(field => {
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'password-toggle';
            toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
            
            field.parentNode.style.position = 'relative';
            field.parentNode.appendChild(toggleBtn);
            
            toggleBtn.addEventListener('click', () => {
                if (field.type === 'password') {
                    field.type = 'text';
                    toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    field.type = 'password';
                    toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    }

    setupRememberMe() {
        const rememberMeCheckbox = document.querySelector('input[name="remember"]');
        if (rememberMeCheckbox) {
            // Load saved preference
            const savedRemember = localStorage.getItem('remember_me');
            if (savedRemember === 'true') {
                rememberMeCheckbox.checked = true;
            }

            // Save preference on change
            rememberMeCheckbox.addEventListener('change', () => {
                localStorage.setItem('remember_me', rememberMeCheckbox.checked);
            });
        }
    }

    setupAnimations() {
        // Animate form elements on load
        const form = document.querySelector('.auth-form');
        if (form) {
            const inputs = form.querySelectorAll('input, button');
            inputs.forEach((input, index) => {
                input.style.animationDelay = `${index * 0.1}s`;
                input.classList.add('animate-in');
            });
        }

        // Add loading state to submit button
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.addEventListener('click', () => {
                if (this.validateForm(submitBtn.closest('form'))) {
                    this.showLoadingState(submitBtn);
                }
            });
        }
    }

    showLoadingState(button) {
        const originalText = button.textContent;
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        
        // Reset after form submission (or timeout for demo)
        setTimeout(() => {
            button.disabled = false;
            button.textContent = originalText;
        }, 3000);
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            notification.remove();
        }, 5000);
        
        // Close button
        notification.querySelector('.notification-close').addEventListener('click', () => {
            notification.remove();
        });
    }
}

// Initialize authentication functionality
document.addEventListener('DOMContentLoaded', () => {
    new AuthApp();
}); 