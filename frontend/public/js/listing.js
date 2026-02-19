/**
 * PropHive - Listing Page JavaScript
 * Handles property listing functionality with filtering and sorting
 */

class ListingApp {
    constructor() {
        this.properties = [];
        this.filteredProperties = [];
        this.currentFilters = {
            type: 'all',
            priceRange: 'all',
            bedrooms: 'all',
            location: 'all'
        };
        this.currentSort = 'featured';
        this.init();
    }

    init() {
        this.loadProperties();
        this.setupFilters();
        this.setupSorting();
        this.setupPropertyCards();
        this.setupSearch();
        this.setupMapView();
        this.setupPagination();
    }

    loadProperties() {
        // Simulate loading properties from API
        this.properties = [
            {
                id: 1,
                title: 'Luxury Villa',
                price: 2500000,
                type: 'villa',
                bedrooms: 5,
                bathrooms: 4,
                location: 'Phnom Penh',
                image: 'image/BIG villa.png',
                featured: true,
                status: 'available'
            },
            {
                id: 2,
                title: 'Downtown Apartment',
                price: 450000,
                type: 'apartment',
                bedrooms: 2,
                bathrooms: 2,
                location: 'Phnom Penh',
                image: 'image/downtown apartment.png',
                featured: false,
                status: 'available'
            },
            {
                id: 3,
                title: 'Office Space',
                price: 1000000,
                type: 'office',
                bedrooms: 0,
                bathrooms: 2,
                location: 'Phnom Penh',
                image: 'image/hell.png',
                featured: false,
                status: 'available'
            },
            {
                id: 4,
                title: 'Beach House',
                price: 3800000,
                type: 'house',
                bedrooms: 4,
                bathrooms: 3,
                location: 'Sihanoukville',
                image: 'image/beach-h.png',
                featured: true,
                status: 'available'
            }
        ];
        
        this.filteredProperties = [...this.properties];
        this.renderProperties();
    }

    setupFilters() {
        // Property type filter
        const typeFilter = document.querySelector('.filter-type');
        if (typeFilter) {
            typeFilter.addEventListener('change', (e) => {
                this.currentFilters.type = e.target.value;
                this.applyFilters();
            });
        }

        // Price range filter
        const priceFilter = document.querySelector('.filter-price');
        if (priceFilter) {
            priceFilter.addEventListener('change', (e) => {
                this.currentFilters.priceRange = e.target.value;
                this.applyFilters();
            });
        }

        // Bedrooms filter
        const bedroomFilter = document.querySelector('.filter-bedrooms');
        if (bedroomFilter) {
            bedroomFilter.addEventListener('change', (e) => {
                this.currentFilters.bedrooms = e.target.value;
                this.applyFilters();
            });
        }

        // Location filter
        const locationFilter = document.querySelector('.filter-location');
        if (locationFilter) {
            locationFilter.addEventListener('change', (e) => {
                this.currentFilters.location = e.target.value;
                this.applyFilters();
            });
        }

        // Clear filters button
        const clearFiltersBtn = document.querySelector('.clear-filters');
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', () => {
                this.clearFilters();
            });
        }
    }

    applyFilters() {
        this.filteredProperties = this.properties.filter(property => {
            // Type filter
            if (this.currentFilters.type !== 'all' && property.type !== this.currentFilters.type) {
                return false;
            }

            // Price range filter
            if (this.currentFilters.priceRange !== 'all') {
                const [min, max] = this.getPriceRange(this.currentFilters.priceRange);
                if (property.price < min || property.price > max) {
                    return false;
                }
            }

            // Bedrooms filter
            if (this.currentFilters.bedrooms !== 'all') {
                const requiredBedrooms = parseInt(this.currentFilters.bedrooms);
                if (property.bedrooms < requiredBedrooms) {
                    return false;
                }
            }

            // Location filter
            if (this.currentFilters.location !== 'all' && property.location !== this.currentFilters.location) {
                return false;
            }

            return true;
        });

        this.applySorting();
        this.renderProperties();
        this.updateFilterCount();
    }

    getPriceRange(range) {
        const ranges = {
            '0-500k': [0, 500000],
            '500k-1m': [500000, 1000000],
            '1m-2m': [1000000, 2000000],
            '2m-5m': [2000000, 5000000],
            '5m+': [5000000, Infinity]
        };
        return ranges[range] || [0, Infinity];
    }

    clearFilters() {
        this.currentFilters = {
            type: 'all',
            priceRange: 'all',
            bedrooms: 'all',
            location: 'all'
        };

        // Reset filter inputs
        document.querySelectorAll('.filter-type, .filter-price, .filter-bedrooms, .filter-location').forEach(select => {
            select.value = 'all';
        });

        this.filteredProperties = [...this.properties];
        this.applySorting();
        this.renderProperties();
        this.updateFilterCount();
    }

    setupSorting() {
        const sortSelect = document.querySelector('.sort-properties');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                this.currentSort = e.target.value;
                this.applySorting();
                this.renderProperties();
            });
        }
    }

    applySorting() {
        switch (this.currentSort) {
            case 'price-low':
                this.filteredProperties.sort((a, b) => a.price - b.price);
                break;
            case 'price-high':
                this.filteredProperties.sort((a, b) => b.price - a.price);
                break;
            case 'newest':
                this.filteredProperties.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                break;
            case 'featured':
                this.filteredProperties.sort((a, b) => b.featured - a.featured);
                break;
            default:
                // Default sorting (featured first, then by price)
                this.filteredProperties.sort((a, b) => {
                    if (a.featured && !b.featured) return -1;
                    if (!a.featured && b.featured) return 1;
                    return a.price - b.price;
                });
        }
    }

    renderProperties() {
        const container = document.querySelector('.property-grid');
        if (!container) return;

        container.innerHTML = '';

        if (this.filteredProperties.length === 0) {
            container.innerHTML = `
                <div class="no-results">
                    <h3>No properties found</h3>
                    <p>Try adjusting your filters or search criteria.</p>
                    <button class="btn btn-primary" onclick="listingApp.clearFilters()">Clear Filters</button>
                </div>
            `;
            return;
        }

        this.filteredProperties.forEach(property => {
            const propertyCard = this.createPropertyCard(property);
            container.appendChild(propertyCard);
        });

        // Re-initialize property card interactions
        this.setupPropertyCards();
    }

    createPropertyCard(property) {
        const card = document.createElement('div');
        card.className = 'property-card';
        card.dataset.propertyId = property.id;
        card.dataset.type = property.type;
        
        card.innerHTML = `
            <div class="property-image">
                <img src="${property.image}" alt="${property.title}">
                ${property.featured ? '<span class="featured-badge">Featured</span>' : ''}
                <div class="property-overlay">
                    <button class="btn btn-primary quick-view" data-property-id="${property.id}">Quick View</button>
                </div>
            </div>
            <div class="property-info">
                <h3>${property.title}</h3>
                <p class="price">$${this.formatPrice(property.price)}</p>
                <div class="property-details">
                    <span><i class="fas fa-bed"></i> ${property.bedrooms} Bed</span>
                    <span><i class="fas fa-bath"></i> ${property.bathrooms} Bath</span>
                    <span><i class="fas fa-map-marker-alt"></i> ${property.location}</span>
                </div>
                <div class="property-actions">
                    <button class="btn btn-outline view-details" data-property-id="${property.id}">View Details</button>
                    <button class="btn btn-outline contact-agent" data-property-id="${property.id}">Contact Agent</button>
                </div>
            </div>
        `;

        return card;
    }

    formatPrice(price) {
        if (price >= 1000000) {
            return (price / 1000000).toFixed(1) + 'M';
        } else if (price >= 1000) {
            return (price / 1000).toFixed(0) + 'K';
        }
        return price.toLocaleString();
    }

    setupPropertyCards() {
        // Quick view functionality
        document.querySelectorAll('.quick-view').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const propertyId = button.dataset.propertyId;
                this.showQuickView(propertyId);
            });
        });

        // View details functionality
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const propertyId = button.dataset.propertyId;
                window.location.href = `/property-details/${propertyId}`;
            });
        });

        // Contact agent functionality
        document.querySelectorAll('.contact-agent').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const propertyId = button.dataset.propertyId;
                this.showContactAgent(propertyId);
            });
        });

        // Card hover effects
        document.querySelectorAll('.property-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hovered');
            });
            
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hovered');
            });
        });
    }

    showQuickView(propertyId) {
        const property = this.properties.find(p => p.id == propertyId);
        if (!property) return;

        const modal = document.createElement('div');
        modal.className = 'quick-view-modal';
        modal.innerHTML = `
            <div class="quick-view-content">
                <span class="close">&times;</span>
                <div class="quick-view-grid">
                    <div class="quick-view-image">
                        <img src="${property.image}" alt="${property.title}">
                    </div>
                    <div class="quick-view-details">
                        <h2>${property.title}</h2>
                        <p class="price">$${this.formatPrice(property.price)}</p>
                        <div class="property-stats">
                            <div class="stat">
                                <i class="fas fa-bed"></i>
                                <span>${property.bedrooms} Bedrooms</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-bath"></i>
                                <span>${property.bathrooms} Bathrooms</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>${property.location}</span>
                            </div>
                        </div>
                        <div class="quick-view-actions">
                            <button class="btn btn-primary" onclick="window.location.href='/property-details/${property.id}'">View Full Details</button>
                            <button class="btn btn-outline" onclick="listingApp.showContactAgent(${property.id})">Contact Agent</button>
                        </div>
                    </div>
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

    showContactAgent(propertyId) {
        const property = this.properties.find(p => p.id == propertyId);
        if (!property) return;

        const modal = document.createElement('div');
        modal.className = 'contact-agent-modal';
        modal.innerHTML = `
            <div class="contact-agent-content">
                <span class="close">&times;</span>
                <h2>Contact Agent</h2>
                <p>Interested in: <strong>${property.title}</strong></p>
                <form class="contact-agent-form">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" placeholder="I'm interested in this property..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        `;

        document.body.appendChild(modal);

        // Form submission
        modal.querySelector('form').addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleContactAgentSubmit(modal, property);
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

    handleContactAgentSubmit(modal, property) {
        const form = modal.querySelector('form');
        const formData = new FormData(form);
        
        // Show loading
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Sending...';
        submitBtn.disabled = true;

        // Simulate API call
        setTimeout(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            modal.remove();
            
            // Show success message
            this.showNotification('Message sent successfully! An agent will contact you soon.', 'success');
        }, 2000);
    }

    setupSearch() {
        const searchInput = document.querySelector('.property-search');
        if (searchInput) {
            let searchTimeout;
            
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.performSearch(e.target.value);
                }, 300);
            });
        }
    }

    performSearch(query) {
        if (!query.trim()) {
            this.filteredProperties = [...this.properties];
        } else {
            this.filteredProperties = this.properties.filter(property => {
                const searchTerm = query.toLowerCase();
                return (
                    property.title.toLowerCase().includes(searchTerm) ||
                    property.location.toLowerCase().includes(searchTerm) ||
                    property.type.toLowerCase().includes(searchTerm)
                );
            });
        }

        this.applySorting();
        this.renderProperties();
    }

    setupMapView() {
        const mapToggle = document.querySelector('.toggle-map-view');
        if (mapToggle) {
            mapToggle.addEventListener('click', () => {
                this.toggleMapView();
            });
        }
    }

    toggleMapView() {
        const container = document.querySelector('.property-grid');
        const mapToggle = document.querySelector('.toggle-map-view');
        
        if (container.classList.contains('map-view')) {
            container.classList.remove('map-view');
            mapToggle.textContent = 'Map View';
        } else {
            container.classList.add('map-view');
            mapToggle.textContent = 'Grid View';
        }
    }

    setupPagination() {
        // Implement pagination if needed
        const itemsPerPage = 12;
        let currentPage = 1;
        
        this.renderPagination();
    }

    renderPagination() {
        const paginationContainer = document.querySelector('.pagination');
        if (!paginationContainer) return;

        const totalPages = Math.ceil(this.filteredProperties.length / 12);
        if (totalPages <= 1) {
            paginationContainer.style.display = 'none';
            return;
        }

        paginationContainer.style.display = 'flex';
        // Add pagination logic here
    }

    updateFilterCount() {
        const countElement = document.querySelector('.filter-count');
        if (countElement) {
            countElement.textContent = `${this.filteredProperties.length} properties found`;
        }
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

// Initialize listing functionality
let listingApp;
document.addEventListener('DOMContentLoaded', () => {
    listingApp = new ListingApp();
}); 