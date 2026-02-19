/**
 * PropHive - Contact Page JavaScript
 * Handles contact form functionality and FAQ interactions
 */

class ContactApp {
    constructor() {
        this.init();
    }

    init() {
        this.setupContactForm();
        this.setupFAQ();
        this.setupMap();
        this.setupAnimations();
        this.setupFormValidation();
    }

    setupContactForm() {
        const form = document.querySelector('.contact-form');
        if (form) {
            // Add form validation attributes
            form.setAttribute('data-validate', 'true');
            
            // Real-time character counter for message
            const messageField = form.querySelector('#message');
            if (messageField) {
                this.setupCharacterCounter(messageField);
            }

            // Auto-save form data
            this.setupAutoSave(form);
        }
    }

    setupCharacterCounter(textarea) {
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.textContent = '0/1000 characters';
        textarea.parentNode.appendChild(counter);

        textarea.addEventListener('input', () => {
            const length = textarea.value.length;
            const maxLength = 1000;
            counter.textContent = `${length}/${maxLength} characters`;
            
            if (length > maxLength * 0.9) {
                counter.classList.add('warning');
            } else {
                counter.classList.remove('warning');
            }
        });
    }

    setupAutoSave(form) {
        const formData = new FormData(form);
        const formKey = 'contact_form_data';
        
        // Load saved data on page load
        const savedData = localStorage.getItem(formKey);
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const field = form.querySelector(`[name="${key}"]`);
                if (field) {
                    field.value = data[key];
                }
            });
        }

        // Save data on input
        form.addEventListener('input', () => {
            const formData = new FormData(form);
            const data = {};
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            localStorage.setItem(formKey, JSON.stringify(data));
        });
    }

    handleFormSubmission(form) {
        if (!this.validateForm(form)) {
            return;
        }

        // Show loading state
        // this.showLoading('Sending your message...');
        
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';

        // Simulate API call
        setTimeout(() => {
            // this.hideLoading();
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
            
            // Show success message
            this.showSuccess('Thank you for your message! We will get back to you within 24 hours.');
            
            // Clear form and saved data
            form.reset();
            localStorage.removeItem('contact_form_data');
            
            // Scroll to success message
            document.querySelector('.notification').scrollIntoView({ behavior: 'smooth' });
        }, 2000);
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
        } else if (field.type === 'tel' && value && !this.isValidPhone(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number.';
        } else if (field.name === 'message' && value.length < 10) {
            isValid = false;
            errorMessage = 'Message must be at least 10 characters long.';
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

    setupFAQ() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('h4');
            const answer = item.querySelector('p');
            
            if (question && answer) {
                // Add click handler
                question.addEventListener('click', () => {
                    this.toggleFAQ(item);
                });

                // Add expand/collapse icon
                const icon = document.createElement('span');
                icon.className = 'faq-icon';
                icon.innerHTML = '<i class="fas fa-plus"></i>';
                question.appendChild(icon);

                // Initially hide answer
                answer.style.display = 'none';
            }
        });
    }

    toggleFAQ(item) {
        const answer = item.querySelector('p');
        const icon = item.querySelector('.faq-icon i');
        const isOpen = item.classList.contains('open');

        // Close all other FAQ items
        document.querySelectorAll('.faq-item').forEach(otherItem => {
            if (otherItem !== item) {
                otherItem.classList.remove('open');
                const otherAnswer = otherItem.querySelector('p');
                const otherIcon = otherItem.querySelector('.faq-icon i');
                if (otherAnswer) otherAnswer.style.display = 'none';
                if (otherIcon) otherIcon.className = 'fas fa-plus';
            }
        });

        // Toggle current item
        if (isOpen) {
            item.classList.remove('open');
            answer.style.display = 'none';
            icon.className = 'fas fa-plus';
        } else {
            item.classList.add('open');
            answer.style.display = 'block';
            icon.className = 'fas fa-minus';
        }
    }

    setupMap() {
        const mapContainer = document.querySelector('.map-container');
        if (mapContainer) {
            // Add interactive map functionality
            this.createInteractiveMap(mapContainer);
        }
    }

    createInteractiveMap(container) {
        // Add map controls
        const mapControls = document.createElement('div');
        mapControls.className = 'map-controls';
        mapControls.innerHTML = `
            <button class="map-btn" data-action="zoom-in">
                <i class="fas fa-plus"></i>
            </button>
            <button class="map-btn" data-action="zoom-out">
                <i class="fas fa-minus"></i>
            </button>
            <button class="map-btn" data-action="locate">
                <i class="fas fa-crosshairs"></i>
            </button>
        `;
        
        container.appendChild(mapControls);

        // Add map interaction handlers
        mapControls.querySelectorAll('.map-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const action = btn.dataset.action;
                this.handleMapAction(action);
            });
        });

        // Add click to get directions
        container.addEventListener('click', (e) => {
            if (e.target.tagName === 'IMG') {
                this.showDirectionsModal();
            }
        });
    }

    handleMapAction(action) {
        switch (action) {
            case 'zoom-in':
                this.showNotification('Zoom in functionality would be implemented with a real map API', 'info');
                break;
            case 'zoom-out':
                this.showNotification('Zoom out functionality would be implemented with a real map API', 'info');
                break;
            case 'locate':
                this.getCurrentLocation();
                break;
        }
    }

    getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    this.showNotification('Location detected! Distance to office: 2.5 km', 'success');
                },
                (error) => {
                    this.showNotification('Unable to get your location. Please enable location services.', 'error');
                }
            );
        } else {
            this.showNotification('Geolocation is not supported by this browser.', 'error');
        }
    }

    showDirectionsModal() {
        const modal = document.createElement('div');
        modal.className = 'directions-modal';
        modal.innerHTML = `
            <div class="directions-content">
                <span class="close">&times;</span>
                <h2>Get Directions</h2>
                <div class="directions-options">
                    <button class="btn btn-primary" onclick="window.open('https://maps.google.com/maps?daddr=PropHive+Office+Phnom+Penh')">
                        <i class="fas fa-map"></i> Google Maps
                    </button>
                    <button class="btn btn-outline" onclick="window.open('https://waze.com/ul?q=PropHive+Office+Phnom+Penh')">
                        <i class="fas fa-car"></i> Waze
                    </button>
                </div>
                <div class="office-info">
                    <h3>Our Office</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Main Street, Phnom Penh, Cambodia</p>
                    <p><i class="fas fa-clock"></i> Mon-Fri: 9:00 AM - 6:00 PM</p>
                    <p><i class="fas fa-phone"></i> +855 12 345 678</p>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Close modal
        modal.querySelector('.close').addEventListener('click', () => {
            modal.remove();
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }

    setupAnimations() {
        // Animate FAQ items on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe FAQ items and contact form
        document.querySelectorAll('.faq-item, .contact-form-container').forEach(el => {
            observer.observe(el);
        });
    }

    setupFormValidation() {
        // Real-time validation
        const form = document.querySelector('.contact-form');
        if (form) {
            form.querySelectorAll('input, textarea').forEach(field => {
                field.addEventListener('blur', () => {
                    this.validateField(field);
                });

                field.addEventListener('input', () => {
                    // Remove error on input
                    this.removeFieldError(field);
                });
            });
        }
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

// Initialize contact page functionality
document.addEventListener('DOMContentLoaded', () => {
    new ContactApp();
}); 