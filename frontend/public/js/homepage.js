/**
 * PropHive - Homepage JavaScript
 * Handles homepage-specific functionality
 */

class HomepageApp {
    constructor() {
        this.init();
    }

    init() {
        this.setupHeroAnimation();
        this.setupServiceCards();
        this.setupPropertyFilter();
        this.setupTestimonialsCarousel();
        this.setupBlogSection();
        this.setupScrollEffects();
    }

    setupHeroAnimation() {
        const hero = document.querySelector('.hero');
        if (hero) {
            // Add typing effect to hero title
            const heroTitle = hero.querySelector('h2');
            if (heroTitle) {
                this.typeWriter(heroTitle, 'Find Your Dream Home', 100);
            }

            // Parallax effect for hero background
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                hero.style.transform = `translateY(${rate}px)`;
            });

            // Animate hero elements on load
            setTimeout(() => {
                hero.classList.add('animated');
            }, 500);
        }
    }

    typeWriter(element, text, speed) {
        let i = 0;
        element.innerHTML = '';
        
        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        type();
    }

    setupServiceCards() {
        const serviceCards = document.querySelectorAll('.service-item');
        
        serviceCards.forEach((card, index) => {
            // Stagger animation on scroll
            card.style.animationDelay = `${index * 0.2}s`;
            
            // Interactive hover effects
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px) scale(1.05)';
                card.style.boxShadow = '0 20px 40px rgba(0,0,0,0.1)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
                card.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
            });

            // Click to learn more
            card.addEventListener('click', () => {
                const serviceType = card.querySelector('h3').textContent.toLowerCase();
                this.showServiceDetails(serviceType);
            });
        });
    }

    showServiceDetails(serviceType) {
        const modal = document.createElement('div');
        modal.className = 'service-modal';
        modal.innerHTML = `
            <div class="service-modal-content">
                <span class="close">&times;</span>
                <h2>${serviceType.charAt(0).toUpperCase() + serviceType.slice(1)} Services</h2>
                <div class="service-details">
                    ${this.getServiceDetails(serviceType)}
                </div>
                <button class="btn btn-primary">Learn More</button>
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

    getServiceDetails(serviceType) {
        const details = {
            'buying': `
                <p>Our buying services include:</p>
                <ul>
                    <li>Property search and selection</li>
                    <li>Market analysis and pricing</li>
                    <li>Negotiation support</li>
                    <li>Legal assistance</li>
                    <li>Financing guidance</li>
                </ul>
            `,
            'selling': `
                <p>Our selling services include:</p>
                <ul>
                    <li>Property valuation</li>
                    <li>Marketing and advertising</li>
                    <li>Professional photography</li>
                    <li>Open house management</li>
                    <li>Closing assistance</li>
                </ul>
            `,
            'renting': `
                <p>Our rental services include:</p>
                <ul>
                    <li>Tenant screening</li>
                    <li>Lease preparation</li>
                    <li>Property maintenance</li>
                    <li>Rent collection</li>
                    <li>Tenant relations</li>
                </ul>
            `,
            'property management': `
                <p>Our property management services include:</p>
                <ul>
                    <li>Day-to-day operations</li>
                    <li>Financial reporting</li>
                    <li>Maintenance coordination</li>
                    <li>Tenant communication</li>
                    <li>Legal compliance</li>
                </ul>
            `
        };
        
        return details[serviceType] || '<p>Service details coming soon...</p>';
    }

    setupPropertyFilter() {
        const filterButtons = document.querySelectorAll('.property-filter-btn');
        const propertyCards = document.querySelectorAll('.property-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.dataset.filter;
                
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                // Filter properties
                propertyCards.forEach(card => {
                    const propertyType = card.dataset.type;
                    if (filter === 'all' || propertyType === filter) {
                        card.style.display = 'block';
                        card.classList.add('filtered-in');
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('filtered-in');
                    }
                });
            });
        });
    }

    setupTestimonialsCarousel() {
        const testimonialContainer = document.querySelector('.testimonial-grid');
        if (testimonialContainer) {
            const testimonials = testimonialContainer.querySelectorAll('.testimonial-card');
            let currentIndex = 0;
            
            // Create navigation
            const nav = document.createElement('div');
            nav.className = 'testimonial-nav';
            nav.innerHTML = `
                <button class="nav-btn prev">&lt;</button>
                <div class="nav-dots"></div>
                <button class="nav-btn next">&gt;</button>
            `;
            
            testimonialContainer.appendChild(nav);
            
            // Create dots
            const dotsContainer = nav.querySelector('.nav-dots');
            testimonials.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.className = 'nav-dot';
                dot.addEventListener('click', () => this.showTestimonial(index));
                dotsContainer.appendChild(dot);
            });
            
            // Navigation buttons
            nav.querySelector('.prev').addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
                this.showTestimonial(currentIndex);
            });
            
            nav.querySelector('.next').addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % testimonials.length;
                this.showTestimonial(currentIndex);
            });
            
            // Auto-rotate
            setInterval(() => {
                currentIndex = (currentIndex + 1) % testimonials.length;
                this.showTestimonial(currentIndex);
            }, 4000);
            
            // Show first testimonial
            this.showTestimonial(0);
        }
    }

    showTestimonial(index) {
        const testimonials = document.querySelectorAll('.testimonial-card');
        const dots = document.querySelectorAll('.nav-dot');
        
        testimonials.forEach((testimonial, i) => {
            testimonial.style.opacity = i === index ? '1' : '0';
            testimonial.style.transform = i === index ? 'translateX(0)' : 'translateX(100px)';
        });
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    setupBlogSection() {
        const blogPosts = document.querySelectorAll('.blog-post');
        
        blogPosts.forEach(post => {
            post.addEventListener('click', () => {
                const title = post.querySelector('h3').textContent;
                this.showBlogPreview(title);
            });
            
            // Hover effects
            post.addEventListener('mouseenter', () => {
                post.style.transform = 'scale(1.05)';
            });
            
            post.addEventListener('mouseleave', () => {
                post.style.transform = 'scale(1)';
            });
        });
    }

    showBlogPreview(title) {
        const modal = document.createElement('div');
        modal.className = 'blog-preview-modal';
        modal.innerHTML = `
            <div class="blog-preview-content">
                <span class="close">&times;</span>
                <h2>${title}</h2>
                <div class="blog-preview-text">
                    <p>This is a preview of the blog post. The full article will be available soon.</p>
                    <p>Stay tuned for more real estate insights and tips!</p>
                </div>
                <button class="btn btn-primary">Read Full Article</button>
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

    setupScrollEffects() {
        // Animate elements on scroll
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

        // Observe sections for animation
        document.querySelectorAll('.services, .featured-properties, .why-choose-us, .testimonials, .blog').forEach(section => {
            observer.observe(section);
        });

        // Parallax effect for sections
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax');
            
            parallaxElements.forEach(element => {
                const rate = scrolled * -0.3;
                element.style.transform = `translateY(${rate}px)`;
            });
        });
    }
}

// Initialize homepage functionality
document.addEventListener('DOMContentLoaded', () => {
    new HomepageApp();
}); 