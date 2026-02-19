@extends('layouts.app')

@section('title', 'Property Details - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/property-details.css') }}">
@endpush

@section('content')
    <section class="property-details-hero">
        <div class="container">
            <div class="property-header modern-card">
                <div class="property-header-info">
                    <h1>{{ $property->title }}</h1>
                    <p class="property-address">{{ $property->address }}</p>
                    <div class="property-price">{{ $property->formatted_price }}</div>
                </div>
                <div class="property-header-image">
                    <img src="{{ asset('image/' . ($property->main_image ?? 'house.png')) }}" alt="{{ $property->title }} main image" style="max-width:100%; max-height:100%; border-radius:12px;">
                </div>
            </div>
        </div>
    </section>

    <section class="property-content">
        <div class="container">
            <div class="property-main-content">
                <!-- Gallery (thumbnails) -->
                <div class="property-gallery modern-card">
                    @foreach($property->images ?? [] as $img)
                        <div class="gallery-item">
                            <img src="{{ asset('image/' . $img) }}" alt="{{ $property->title }} gallery image" style="max-width:100%; max-height:100%; border-radius:8px;">
                        </div>
                    @endforeach
                </div>
                <!-- Property Info Card -->
                <div class="property-info modern-card">
                    <h2>Property Information</h2>
                    <div class="property-info-grid">
                        <div class="info-item"><span>🛏️ {{ $property->bedrooms }} Bedrooms</span></div>
                        <div class="info-item"><span>🛁 {{ $property->bathrooms }} Bathrooms</span></div>
                        <div class="info-item"><span>📏 {{ $property->square_feet }} sq ft</span></div>
                        <div class="info-item"><span>🚗 {{ $property->parking ?? 0 }} Parking</span></div>
                        <div class="info-item"><span>🏢 {{ $property->type }}</span></div>
                        <div class="info-item"><span>📍 {{ $property->city }}</span></div>
                    </div>
                </div>
            </div>
            <!-- Description & Features -->
            <div class="modern-card property-description-section">
                <h2>Description</h2>
                <p>{{ $property->description }}</p>
                <h3>Key Features:</h3>
                <ul>
                    @foreach($property->features ?? [] as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
            <!-- Agent Card -->
            <div class="modern-card agent-section">
                <h2>Contact Agent</h2>
                <div class="agent-info-flex">
                    <div class="agent-avatar-placeholder">
                        <img src="{{ asset('image/' . ($property->agent->avatar ?? 'teto.jpg')) }}" alt="Agent avatar" style="width:80px; height:80px; border-radius:50%; object-fit:cover;">
                    </div>
                    <div class="agent-details">
                        <h3>{{ $property->agent->name ?? 'N/A' }}</h3>
                        <p>{{ $property->agent->role ?? 'Agent' }}</p>
                        <p>📞 {{ $property->agent->phone ?? '' }}</p>
                        <p>✉️ {{ $property->agent->email ?? '' }}</p>
                    </div>
                </div>
            </div>
            <!-- Map Card -->
            <div class="modern-card property-map-section">
                <h2>Location</h2>
                <img src="{{ asset('image/mappa.jpg') }}" alt="Property map" style="max-width:100%; border-radius:12px;">
            </div>
            <!-- Similar Properties -->
            <div class="modern-card similar-properties-section">
                <h2>Similar Properties</h2>
                <div class="similar-properties-grid">
                    @foreach($similarProperties as $simProp)
                        <div class="similar-property-card">
                            <img src="{{ asset('image/' . ($simProp->main_image ?? 'house.png')) }}" alt="{{ $simProp->title }} image" style="width:100%; max-width:120px; border-radius:8px;">
                            <div class="similar-info">
                                <h3>{{ $simProp->title }}</h3>
                                <p class="price">{{ $simProp->formatted_price }}</p>
                                <p class="location">{{ $simProp->city }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/property-details.js') }}"></script>
@endpush
