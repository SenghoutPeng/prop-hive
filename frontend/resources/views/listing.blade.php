@extends('layouts.app')

@section('title', 'Property Listings - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/listing.css') }}">
@endpush

@section('content')
    <section class="listing-hero">
        <div class="container">
            <h1>Property Listings</h1>
            <p>Find your perfect property from our extensive collection</p>
        </div>
    </section>

    <section class="listing-content">
        <div class="container">
            <!-- Search and Filter Section -->
            <div class="search-filter-section">
                <form class="property-search-form" data-validate="true">
                    <div class="search-row">
                        <div class="search-group">
                            <input type="text" class="property-search" placeholder="Search properties...">
                        </div>
                        <div class="filter-group">
                            <select class="filter-type">
                                <option value="all">All Types</option>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="villa">Villa</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-price">
                                <option value="all">All Prices</option>
                                <option value="0-500k">Under $500K</option>
                                <option value="500k-1m">$500K - $1M</option>
                                <option value="1m-2m">$1M - $2M</option>
                                <option value="2m-5m">$2M - $5M</option>
                                <option value="5m+">$5M+</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-bedrooms">
                                <option value="all">Any Bedrooms</option>
                                <option value="1">1+ Bedroom</option>
                                <option value="2">2+ Bedrooms</option>
                                <option value="3">3+ Bedrooms</option>
                                <option value="4">4+ Bedrooms</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-location">
                                <option value="all">All Locations</option>
                                <option value="Phnom Penh">Phnom Penh</option>
                                <option value="Sihanoukville">Sihanoukville</option>
                                <option value="Siem Reap">Siem Reap</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                
                <div class="filter-actions">
                    <button class="clear-filters btn btn-outline">Clear Filters</button>
                    <button class="toggle-map-view btn btn-outline">Map View</button>
                </div>
            </div>

            <!-- Results Section -->
            <div class="results-section">
                <div class="results-header">
                    <div class="results-info">
                        <span class="filter-count">4 properties found</span>
                    </div>
                    <div class="sort-section">
                        <label for="sort-properties">Sort by:</label>
                        <select class="sort-properties">
                            <option value="featured">Featured</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="newest">Newest</option>
                        </select>
                    </div>
                </div>

                <!-- Property Grid -->
                <div class="property-grid-wrapper">
                  <div class="property-grid">
                    @foreach($properties as $property)
                        <x-property-card 
                            :image="'image/' . ($property->main_image ?? 'house.png')"
                            :title="$property->title"
                            :price="$property->formatted_price"
                            :location="$property->city"
                            :bedrooms="$property->bedrooms"
                            :bathrooms="$property->bathrooms"
                            :featured="$property->is_featured"
                            :description="Str::limit($property->description, 80)"
                            :data-type="$property->type"
                            :data-property-id="$property->id"
                        />
                    @endforeach
                  </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <!-- Pagination will be generated by JavaScript -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/listing.js') }}"></script>
@endpush
