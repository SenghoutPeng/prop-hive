@extends('layouts.app')

@section('title', 'Property Listings - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/listing.css') }}">
@endpush

@section('content')
    @php
        $resolveListingImage = function ($rawImage) {
            $image = trim((string) ($rawImage ?? ''));

            if ($image === '') {
                return asset('image/house.png');
            }

            if (filter_var($image, FILTER_VALIDATE_URL)) {
                return $image;
            }

            $image = ltrim($image, '/');

            if (str_starts_with($image, 'storage/')) {
                return asset($image);
            }

            // Backend property management stores uploads as properties/<filename>
            if (str_starts_with($image, 'properties/')) {
                return asset('storage/' . $image);
            }

            if (str_starts_with($image, 'image/')) {
                return asset($image);
            }

            return asset('image/' . $image);
        };

        $listingProperties = $properties->map(function ($property) use ($resolveListingImage) {
            $imageUrl = $resolveListingImage($property->main_image);

            return [
                'id' => $property->id,
                'title' => $property->title,
                'price' => (float) $property->price,
                'type' => $property->type,
                'bedrooms' => $property->bedrooms,
                'bathrooms' => $property->bathrooms,
                'location' => $property->address,
                'image' => $imageUrl,
                'featured' => (bool) $property->is_featured,
                'status' => $property->status,
                'description' => Str::limit($property->description, 80),
                'created_at' => optional($property->created_at)->toIso8601String(),
            ];
        });
    @endphp

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
                        <span class="filter-count">{{ $properties->count() }} properties found</span>
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
                            :image="$resolveListingImage($property->main_image)"
                            :title="$property->title"
                            :price="$property->formatted_price"
                            :location="$property->address"
                            :bedrooms="$property->bedrooms"
                            :bathrooms="$property->bathrooms"
                            :featured="$property->is_featured"
                            :description="Str::limit($property->description, 80)"
                            :data-price="$property->price"
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
    <script>
        window.listingProperties = @json($listingProperties);
        window.listingFallbackImage = @json(asset('image/house.png'));
    </script>
    <script src="{{ asset('js/listing.js') }}"></script>
@endpush
