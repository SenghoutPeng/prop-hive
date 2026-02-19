@extends('layouts.app')

@section('title', 'PropHive - Find Your Dream Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endpush

@section('content')
    <section class="hero animate-on-scroll">
        <div class="container text-center">
            <h2>Find Your Dream Home</h2>
            <p>Explore our properties and find your perfect match.</p>
            <a href="{{ route('listing') }}" class="btn btn-dark">Search Properties</a>
        </div>
    </section>

    <section class="services animate-on-scroll">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">We provide comprehensive real estate services.</p>
            <div class="service-grid">
                <x-service-card 
                    image="image/buying.png"
                    title="Buying"
                    description="We help you find your dream property."
                />
                <x-service-card 
                    image="image/sell.png"
                    title="Selling"
                    description="Get the best price for your listing."
                />
                <x-service-card 
                    image="image/rent.png"
                    title="Renting"
                    description="Find the perfect rental home."
                />
                <x-service-card 
                    image="image/propman.png"
                    title="Property Management"
                    description="We manage your properties for you."
                />
            </div>
        </div>
    </section>

    <section class="featured-properties animate-on-scroll">
        <div class="container">
            <h2 class="section-title">Featured Properties</h2>
            <p class="section-subtitle">Discover our latest listings.</p>
            <div class="property-grid">
                <x-property-card 
                    image="image/house.png"
                    title="Luxury Home"
                    price="$1,000,000"
                    data-type="house"
                />
                <x-property-card 
                    image="image/apartment.png"
                    title="City Apartment"
                    price="$750,000"
                    data-type="apartment"
                />
                <x-property-card 
                    image="image/famhouse.png"
                    title="Family House"
                    price="$500,000"
                    data-type="house"
                />
            </div>
            <div class="text-center">
                <a href="{{ route('listing') }}" class="btn btn-dark">View More</a>
            </div>
        </div>
    </section>

    <div class="combined-section">
        <section class="why-choose-us animate-on-scroll">
            <div class="container">
                <h2 class="section-title">Why Choose Us?</h2>
                <p class="section-subtitle">See what sets us apart from the competition.</p>
                <div class="features-list">
                    <div class="feature-item">
                        <img src="{{ asset('image/Screenshot_2025-06-25_193926-removebg-preview.png') }}" alt="Expert Agents">
                        <div class="feature-text">
                            <h3>Expert Agents</h3>
                            <p>Professional and experienced agents.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <img src="{{ asset('image/image_2025-06-25_193956114-removebg-preview.png') }}" alt="Fast Closing">
                        <div class="feature-text">
                            <h3>Fast Closing</h3>
                            <p>We close deals quickly.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <img src="{{ asset('image/Screenshot_2025-06-25_193933-removebg-preview.png') }}" alt="Trusted Partners">
                        <div class="feature-text">
                            <h3>Trusted Partners</h3>
                            <p>We are the trusted choice.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials animate-on-scroll">
            <div class="container">
                <h2 class="section-title">What Our Clients Say</h2>
                <p class="section-subtitle">Hear from our satisfied clients.</p>
                <div class="testimonial-grid">
                    <x-testimonial-card 
                        image="image/wwe.jpg"
                        name="John Cena"
                        testimonial="Amazing service, found my dream home!"
                        subtitle="he's invisible."
                    />
                    <x-testimonial-card 
                        image="image/ashton.png"
                        name="ashton hall"
                        testimonial="Professionals who care about their clients."
                        subtitle="and loses to speed 4-0 XD"
                    />
                </div>
            </div>
        </section>
    </div>

    <section class="blog animate-on-scroll">
        <div class="container">
            <h2 class="section-title">Latest from Our Blog</h2>
            <p class="section-subtitle">Stay updated with our insights.</p>
            <div class="blog-grid">
                <div class="blog-post">
                    <img src="{{ asset('image/image 13.png') }}" alt="Blog Post 1">
                    <h3>5 tips for first-time homebuyers.</h3>
                </div>
                <div class="blog-post">
                    <img src="{{ asset('image/image 12.png') }}" alt="Blog Post 2">
                    <h3>What's hot in the real estate market?</h3>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/homepage.js') }}"></script>
@endpush