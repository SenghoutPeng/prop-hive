/**
 * PropHive - Main JavaScript Application
 * Handles core functionality across all pages
 */

class PropHiveApp {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.initializeComponents();
        this.setupAnimations();
        this.handleResponsiveNavigation();
    }

    setupEventListeners() {
        // Mobile navigation toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
                mobileMenuToggle.classList.toggle('active');
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Form validation
        this.setupFormValidation();

        // Property search functionality
        this.setupPropertySearch();

        // Image lazy loading
        this.setupLazyLoading();

        // Back to top button
        this.setupBackToTop();
    }

    initializeComponents() {
        // Initialize property cards
        this.initializePropertyCards();
        
        // Initialize testimonials slider
        this.initializeTestimonialsSlider();
        
        // Initialize team member cards
        this.initializeTeamCards();
        
        // Initialize contact form
        this.initializeContactForm();
    }

    setupAnimations() {
        // Intersection Observer for scroll animations
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

        // Observe elements for animation
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    }

    handleResponsiveNavigation() {
        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                if (!mobileMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                    mobileMenu.classList.remove('active');
                    mobileMenuToggle.classList.remove('active');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            const mobileMenu = document.querySelector('.mobile-menu');
            if (window.innerWidth > 768 && mobileMenu) {
                mobileMenu.classList.remove('active');
            }
        });
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
            form.querySelectorAll('input, textarea, select').forEach(field => {
                field.addEventListener('blur', () => {
                    this.validateField(field);
                });
            });
        });
    }

    validateForm(form) {
        let isValid = true;
        const fields = form.querySelectorAll('input[required], textarea[required], select[required]');
        
        fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        return isValid;
    }

    validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
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
        } else if (field.hasAttribute('minlength')) {
            const minLength = parseInt(field.getAttribute('minlength'));
            if (value.length < minLength) {
                isValid = false;
                errorMessage = `Minimum ${minLength} characters required.`;
            }
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

    setupPropertySearch() {
        const searchForm = document.querySelector('.property-search-form');
        if (searchForm) {
            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.performPropertySearch(searchForm);
            });
        }
    }

    performPropertySearch(form) {
        const formData = new FormData(form);
        const searchParams = new URLSearchParams(formData);
        
        // Show loading state
        this.showLoading('Searching properties...');
        
        // Simulate API call (replace with actual API endpoint)
        setTimeout(() => {
            this.hideLoading();
            // Redirect to search results page
            window.location.href = `/listing?${searchParams.toString()}`;
        }, 1000);
    }

    setupLazyLoading() {
        const images = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    setupBackToTop() {
        const backToTopBtn = document.createElement('button');
        backToTopBtn.className = 'back-to-top';
        backToTopBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
        document.body.appendChild(backToTopBtn);

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    initializePropertyCards() {
        const propertyCards = document.querySelectorAll('.property-card');
        
        propertyCards.forEach(card => {
            // Add hover effects
            card.addEventListener('mouseenter', () => {
                card.classList.add('hovered');
            });
            
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hovered');
            });

            // Add click to view details
            card.addEventListener('click', () => {
                const propertyId = card.dataset.propertyId;
                if (propertyId) {
                    window.location.href = `/property-details/${propertyId}`;
                }
            });
        });
    }

    initializeTestimonialsSlider() {
        const testimonialContainer = document.querySelector('.testimonial-slider');
        if (testimonialContainer) {
            this.createTestimonialSlider(testimonialContainer);
        }
    }

    createTestimonialSlider(container) {
        const testimonials = container.querySelectorAll('.testimonial-card');
        let currentIndex = 0;

        // Create navigation dots
        const dotsContainer = document.createElement('div');
        dotsContainer.className = 'testimonial-dots';
        
        testimonials.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = 'testimonial-dot';
            dot.addEventListener('click', () => this.showTestimonial(index));
            dotsContainer.appendChild(dot);
        });
        
        container.appendChild(dotsContainer);

        // Auto-rotate testimonials
        setInterval(() => {
            currentIndex = (currentIndex + 1) % testimonials.length;
            this.showTestimonial(currentIndex);
        }, 5000);

        // Show first testimonial
        this.showTestimonial(0);
    }

    showTestimonial(index) {
        const testimonials = document.querySelectorAll('.testimonial-card');
        const dots = document.querySelectorAll('.testimonial-dot');
        
        testimonials.forEach((testimonial, i) => {
            testimonial.style.display = i === index ? 'block' : 'none';
        });
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    initializeTeamCards() {
        const teamCards = document.querySelectorAll('.team-member-card');
        
        teamCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hovered');
            });
            
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hovered');
            });
        });
    }

    initializeContactForm() {
        const contactForm = document.querySelector('.contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleContactFormSubmit(contactForm);
            });
        }
    }

    handleContactFormSubmit(form) {
        if (this.validateForm(form)) {
            this.showLoading('Sending message...');
            
            // Simulate form submission
            setTimeout(() => {
                this.hideLoading();
                this.showSuccess('Message sent successfully! We will get back to you soon.');
                form.reset();
            }, 2000);
        }
    }

    showLoading(message = 'Loading...') {
        const loading = document.createElement('div');
        loading.className = 'loading-overlay';
        loading.innerHTML = `
            <div class="loading-spinner">
                <div class="spinner"></div>
                <p>${message}</p>
            </div>
        `;
        document.body.appendChild(loading);
    }

    hideLoading() {
        const loading = document.querySelector('.loading-overlay');
        if (loading) {
            loading.remove();
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

// Initialize the application when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new PropHiveApp();
});

// Export for use in other modules
window.PropHiveApp = PropHiveApp; 