/**
 * PropHive - Property Details JavaScript
 * Handles property details page functionality
 */

class PropertyDetailsApp {
    constructor() {
        this.currentImageIndex = 0;
        this.images = [];
        this.init();
    }

    init() {
        this.setupImageGallery();
        this.setupContactForm();
        this.setupPropertyActions();
        this.setupMap();
        this.setupAnimations();
        this.setupShareFunctionality();
    }

    setupImageGallery() {
        const gallery = document.querySelector('.property-gallery');
        if (gallery) {
            this.images = gallery.querySelectorAll('.gallery-image');
            this.setupGalleryNavigation();
            this.setupThumbnailNavigation();
            this.setupFullscreenView();
        }
    }

    setupGalleryNavigation() {
        const prevBtn = document.querySelector('.gallery-prev');
        const nextBtn = document.querySelector('.gallery-next');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                this.showPreviousImage();
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                this.showNextImage();
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                this.showPreviousImage();
            } else if (e.key === 'ArrowRight') {
                this.showNextImage();
            } else if (e.key === 'Escape') {
                this.closeFullscreen();
            }
        });
    }

    showPreviousImage() {
        this.currentImageIndex = (this.currentImageIndex - 1 + this.images.length) % this.images.length;
        this.updateGalleryDisplay();
    }

    showNextImage() {
        this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
        this.updateGalleryDisplay();
    }

    updateGalleryDisplay() {
        // Update main image
        const mainImage = document.querySelector('.main-gallery-image');
        if (mainImage && this.images[this.currentImageIndex]) {
            mainImage.src = this.images[this.currentImageIndex].src;
            mainImage.alt = this.images[this.currentImageIndex].alt;
        }

        // Update thumbnails
        const thumbnails = document.querySelectorAll('.gallery-thumbnail');
        thumbnails.forEach((thumb, index) => {
            thumb.classList.toggle('active', index === this.currentImageIndex);
        });

        // Update counter
        const counter = document.querySelector('.gallery-counter');
        if (counter) {
            counter.textContent = `${this.currentImageIndex + 1} / ${this.images.length}`;
        }
    }

    setupThumbnailNavigation() {
        const thumbnails = document.querySelectorAll('.gallery-thumbnail');
        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                this.currentImageIndex = index;
                this.updateGalleryDisplay();
            });
        });
    }

    setupFullscreenView() {
        const mainImage = document.querySelector('.main-gallery-image');
        if (mainImage) {
            mainImage.addEventListener('click', () => {
                this.openFullscreen();
            });
        }
    }

    openFullscreen() {
        const fullscreen = document.createElement('div');
        fullscreen.className = 'fullscreen-gallery';
        fullscreen.innerHTML = `
            <div class="fullscreen-content">
                <button class="fullscreen-close">&times;</button>
                <button class="fullscreen-prev">&lt;</button>
                <button class="fullscreen-next">&gt;</button>
                <img src="${this.images[this.currentImageIndex].src}" alt="Fullscreen view">
                <div class="fullscreen-counter">${this.currentImageIndex + 1} / ${this.images.length}</div>
            </div>
        `;

        document.body.appendChild(fullscreen);

        // Event listeners
        fullscreen.querySelector('.fullscreen-close').addEventListener('click', () => {
            this.closeFullscreen();
        });

        fullscreen.querySelector('.fullscreen-prev').addEventListener('click', () => {
            this.showPreviousImage();
            this.updateFullscreenImage();
        });

        fullscreen.querySelector('.fullscreen-next').addEventListener('click', () => {
            this.showNextImage();
            this.updateFullscreenImage();
        });

        fullscreen.addEventListener('click', (e) => {
            if (e.target === fullscreen) {
                this.closeFullscreen();
            }
        });
    }

    updateFullscreenImage() {
        const fullscreenImg = document.querySelector('.fullscreen-gallery img');
        const fullscreenCounter = document.querySelector('.fullscreen-counter');
        
        if (fullscreenImg) {
            fullscreenImg.src = this.images[this.currentImageIndex].src;
        }
        
        if (fullscreenCounter) {
            fullscreenCounter.textContent = `${this.currentImageIndex + 1} / ${this.images.length}`;
        }
    }

    closeFullscreen() {
        const fullscreen = document.querySelector('.fullscreen-gallery');
        if (fullscreen) {
            fullscreen.remove();
        }
    }

    setupContactForm() {
        const form = document.querySelector('.contact-agent-form');
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

            // Form submission
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleContactSubmission(form);
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

    handleContactSubmission(form) {
        if (!this.validateForm(form)) {
            return;
        }

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

        // Simulate API call
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
            this.showSuccess('Message sent successfully! An agent will contact you soon.');
            form.reset();
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

    setupPropertyActions() {
        // Schedule viewing
        const scheduleBtn = document.querySelector('.schedule-viewing');
        if (scheduleBtn) {
            scheduleBtn.addEventListener('click', () => {
                this.showScheduleModal();
            });
        }

        // Favorite property
        const favoriteBtn = document.querySelector('.favorite-property');
        if (favoriteBtn) {
            favoriteBtn.addEventListener('click', () => {
                this.toggleFavorite(favoriteBtn);
            });
        }

        // Share property
        const shareBtn = document.querySelector('.share-property');
        if (shareBtn) {
            shareBtn.addEventListener('click', () => {
                this.showShareModal();
            });
        }
    }

    showScheduleModal() {
        const modal = document.createElement('div');
        modal.className = 'schedule-modal';
        modal.innerHTML = `
            <div class="schedule-content">
                <span class="close">&times;</span>
                <h2>Schedule a Viewing</h2>
                <form class="schedule-form" data-validate="true">
                    <div class="form-group">
                        <label for="viewing-name">Your Name *</label>
                        <input type="text" id="viewing-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="viewing-email">Email *</label>
                        <input type="email" id="viewing-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="viewing-phone">Phone</label>
                        <input type="tel" id="viewing-phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="viewing-date">Preferred Date *</label>
                        <input type="date" id="viewing-date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="viewing-time">Preferred Time *</label>
                        <select id="viewing-time" name="time" required>
                            <option value="">Select time</option>
                            <option value="09:00">9:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="16:00">4:00 PM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="viewing-notes">Additional Notes</label>
                        <textarea id="viewing-notes" name="notes" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Schedule Viewing</button>
                </form>
            </div>
        `;

        document.body.appendChild(modal);

        // Form submission
        modal.querySelector('form').addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleScheduleSubmission(modal);
        });

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

    handleScheduleSubmission(modal) {
        const form = modal.querySelector('form');
        if (this.validateForm(form)) {
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Scheduling...';

            setTimeout(() => {
                modal.remove();
                this.showSuccess('Viewing scheduled successfully! We will confirm the appointment shortly.');
            }, 2000);
        }
    }

    toggleFavorite(button) {
        const isFavorited = button.classList.contains('favorited');
        
        if (isFavorited) {
            button.classList.remove('favorited');
            button.innerHTML = '<i class="far fa-heart"></i> Add to Favorites';
            this.showNotification('Removed from favorites', 'info');
        } else {
            button.classList.add('favorited');
            button.innerHTML = '<i class="fas fa-heart"></i> Favorited';
            this.showSuccess('Added to favorites!');
        }
    }

    showShareModal() {
        const modal = document.createElement('div');
        modal.className = 'share-modal';
        modal.innerHTML = `
            <div class="share-content">
                <span class="close">&times;</span>
                <h2>Share This Property</h2>
                <div class="share-options">
                    <button class="share-btn" data-platform="facebook">
                        <i class="fab fa-facebook"></i> Facebook
                    </button>
                    <button class="share-btn" data-platform="twitter">
                        <i class="fab fa-twitter"></i> Twitter
                    </button>
                    <button class="share-btn" data-platform="linkedin">
                        <i class="fab fa-linkedin"></i> LinkedIn
                    </button>
                    <button class="share-btn" data-platform="whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </button>
                    <button class="share-btn" data-platform="email">
                        <i class="fas fa-envelope"></i> Email
                    </button>
                </div>
                <div class="share-link">
                    <label>Direct Link:</label>
                    <div class="link-container">
                        <input type="text" value="${window.location.href}" readonly>
                        <button class="copy-link">Copy</button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Share buttons
        modal.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                this.shareProperty(btn.dataset.platform);
            });
        });

        // Copy link
        modal.querySelector('.copy-link').addEventListener('click', () => {
            this.copyToClipboard(window.location.href);
        });

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

    shareProperty(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        
        const shareUrls = {
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
            twitter: `https://twitter.com/intent/tweet?url=${url}&text=${title}`,
            linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${url}`,
            whatsapp: `https://wa.me/?text=${title}%20${url}`,
            email: `mailto:?subject=${title}&body=Check out this property: ${url}`
        };

        if (shareUrls[platform]) {
            window.open(shareUrls[platform], '_blank', 'width=600,height=400');
        }
    }

    copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            this.showSuccess('Link copied to clipboard!');
        }).catch(() => {
            this.showError('Failed to copy link');
        });
    }

    setupMap() {
        const mapContainer = document.querySelector('.property-map');
        if (mapContainer) {
            // Add map controls
            const mapControls = document.createElement('div');
            mapControls.className = 'map-controls';
            mapControls.innerHTML = `
                <button class="map-btn" data-action="directions">
                    <i class="fas fa-directions"></i> Get Directions
                </button>
                <button class="map-btn" data-action="street-view">
                    <i class="fas fa-street-view"></i> Street View
                </button>
            `;
            
            mapContainer.appendChild(mapControls);

            // Map controls
            mapControls.querySelectorAll('.map-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    this.handleMapAction(btn.dataset.action);
                });
            });
        }
    }

    handleMapAction(action) {
        const propertyAddress = document.querySelector('.property-address')?.textContent || '';
        
        switch (action) {
            case 'directions':
                window.open(`https://maps.google.com/maps?daddr=${encodeURIComponent(propertyAddress)}`, '_blank');
                break;
            case 'street-view':
                window.open(`https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=${encodeURIComponent(propertyAddress)}`, '_blank');
                break;
        }
    }

    setupAnimations() {
        // Animate property details on scroll
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

        // Observe sections
        document.querySelectorAll('.property-section').forEach(section => {
            observer.observe(section);
        });
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

// Initialize property details functionality
document.addEventListener('DOMContentLoaded', () => {
    new PropertyDetailsApp();
}); 