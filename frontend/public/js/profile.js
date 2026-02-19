/**
 * PropHive - Profile Page JavaScript
 * Handles profile management functionality
 */

class ProfileApp {
    constructor() {
        this.init();
    }

    init() {
        this.setupProfileForm();
        this.setupAvatarUpload();
        this.setupPreferences();
        this.setupNotifications();
        this.setupAnimations();
    }

    setupProfileForm() {
        const form = document.querySelector('.profile-form');
        if (form) {
            form.setAttribute('data-validate', 'true');
            
            // Real-time validation
            form.querySelectorAll('input, textarea').forEach(field => {
                field.addEventListener('blur', () => {
                    this.validateField(field);
                });

                field.addEventListener('input', () => {
                    this.removeFieldError(field);
                });
            });
        }
    }

    validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        this.removeFieldError(field);

        if (field.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'This field is required.';
        } else if (field.type === 'email' && value && !this.isValidEmail(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address.';
        } else if (field.type === 'tel' && value && !this.isValidPhone(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number.';
        } else if (field.name === 'password' && value && value.length < 6) {
            isValid = false;
            errorMessage = 'Password must be at least 6 characters long.';
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

    setupAvatarUpload() {
        const avatarInput = document.querySelector('.avatar-input');
        const avatarPreview = document.querySelector('.avatar-preview');
        
        if (avatarInput && avatarPreview) {
            avatarInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    if (this.validateImage(file)) {
                        this.previewImage(file, avatarPreview);
                    } else {
                        this.showError('Please select a valid image file (JPG, PNG, GIF) under 2MB.');
                        avatarInput.value = '';
                    }
                }
            });
        }
    }

    validateImage(file) {
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        return validTypes.includes(file.type) && file.size <= maxSize;
    }

    previewImage(file, previewElement) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewElement.src = e.target.result;
            previewElement.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    setupPreferences() {
        const preferenceToggles = document.querySelectorAll('.preference-toggle');
        
        preferenceToggles.forEach(toggle => {
            toggle.addEventListener('change', () => {
                this.savePreference(toggle.name, toggle.checked);
            });
        });
    }

    savePreference(name, value) {
        // Save to localStorage for demo
        localStorage.setItem(`preference_${name}`, value);
        
        // Show feedback
        const status = value ? 'enabled' : 'disabled';
        this.showNotification(`${name.replace('_', ' ')} ${status}`, 'success');
    }

    setupNotifications() {
        const notificationSettings = document.querySelectorAll('.notification-setting');
        
        notificationSettings.forEach(setting => {
            setting.addEventListener('change', () => {
                this.updateNotificationSetting(setting);
            });
        });
    }

    updateNotificationSetting(setting) {
        const type = setting.dataset.type;
        const enabled = setting.checked;
        
        // Save setting
        localStorage.setItem(`notification_${type}`, enabled);
        
        // Show feedback
        const status = enabled ? 'enabled' : 'disabled';
        this.showNotification(`${type} notifications ${status}`, 'info');
    }

    setupAnimations() {
        // Animate profile sections on load
        const sections = document.querySelectorAll('.profile-section');
        sections.forEach((section, index) => {
            section.style.animationDelay = `${index * 0.2}s`;
            section.classList.add('animate-in');
        });

        // Animate stats
        this.animateStats();
    }

    animateStats() {
        const stats = document.querySelectorAll('.stat-number');
        stats.forEach(stat => {
            const target = parseInt(stat.dataset.target) || 0;
            this.animateNumber(stat, 0, target, 2000);
        });
    }

    animateNumber(element, start, end, duration) {
        const startTime = performance.now();
        
        function updateNumber(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            const current = Math.floor(start + (end - start) * progress);
            element.textContent = current;
            
            if (progress < 1) {
                requestAnimationFrame(updateNumber);
            }
        }
        
        requestAnimationFrame(updateNumber);
    }

    showSuccess(message) {
        this.showNotification(message, 'success');
    }

    showError(message) {
        this.showNotification(message, 'error');
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 5000);
        
        notification.querySelector('.notification-close').addEventListener('click', () => {
            notification.remove();
        });
    }
}

// Initialize profile functionality
document.addEventListener('DOMContentLoaded', () => {
    new ProfileApp();
}); 