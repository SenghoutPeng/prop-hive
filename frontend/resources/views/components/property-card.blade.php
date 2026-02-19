<div class="property-card property-card-horizontal">
    <div class="property-image-wrapper">
        <img src="{{ asset($image) }}" alt="{{ $title }}">
        @if(isset($featured) && $featured)
            <span class="property-badge">Featured</span>
        @endif
    </div>
    <div class="property-info-overlay">
        <h3>{{ $title }}</h3>
        <p class="price">{{ $price }}</p>
        @if(isset($location))
            <p class="location"><i class="fas fa-map-marker-alt"></i> {{ $location }}</p>
        @endif
        @if(isset($bedrooms) || isset($bathrooms))
            <div class="property-meta">
                @if(isset($bedrooms))<span><i class="fas fa-bed"></i> {{ $bedrooms }} Bed</span>@endif
                @if(isset($bathrooms))<span><i class="fas fa-bath"></i> {{ $bathrooms }} Bath</span>@endif
            </div>
        @endif
        @if(isset($description))
            <div class="property-description">
                <p>{{ $description }}</p>
            </div>
        @endif
    </div>
</div> 