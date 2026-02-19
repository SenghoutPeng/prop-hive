@extends('layouts.app')

@section('title', 'Our Clients - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/our-client.css') }}">
@endpush

@section('content')
    <section class="clients-hero">
        <div class="container text-center">
            <h2>Meet Our Clients</h2>
            <p>We are proud to work with a diverse group of clients. Here's a look at some of them.</p>
            <div class="hero-buttons">
                <a href="/testimonials" class="btn btn-light">View All Clients</a>
                <a href="/contact-us" class="btn btn-dark">Contact Us</a>
            </div>
        </div>
    </section>

    <section class="featured-clients">
        <div class="container featured-clients-container">
            <div class="featured-clients-title">
                <h2>Featured Clients</h2>
                <p>A selection of our notable clients.</p>
            </div>
            <div class="featured-clients-grid">
                <div class="client-card">
                    <img src="{{ asset('image/ufotable.png') }}" alt="ufotable">
                    <h3>Company A</h3>
                    <p class="client-industry">Technology</p>
                    <p class="client-desc">Leading tech solutions provider.</p>
                </div>
                <div class="client-card">
                    <img src="{{ asset('image/A1.webp') }}" alt="A-1 picture">
                    <h3>Company B</h3>
                    <p class="client-industry">Retail</p>
                    <p class="client-desc">Innovative e-commerce platform.</p>
                </div>
                <div class="client-card">
                    <img src="{{ asset('image/mappa.jpg') }}" alt="mappa">
                    <h3>Company C</h3>
                    <p class="client-industry">Healthcare</p>
                    <p class="client-desc">Global healthcare services.</p>
                </div>
                <div class="client-card">
                    <img src="{{ asset('image/nromal company.jpg') }}" alt="ubisoft">
                    <h3>Company D</h3>
                    <p class="client-industry">Finance</p>
                    <p class="client-desc">Trusted financial advisory firm.</p>
                </div>
            </div>
        </div>
    </section>
    
    <div class="section-divider"></div>

    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Client Testimonials</h2>
            <p class="section-subtitle">Hear what our clients have to say about us.</p>
            <div class="testimonial-list">
                <div class="testimonial-item">
                    <img src="{{ asset('image/ufoceo.jpg') }}" alt="Client A Logo" class="testimonial-logo">
                    <div class="testimonial-content">
                        <h3>Client A</h3>
                        <p class="testimonial-source">Director, Company A</p>
                        <p class="testimonial-quote">"Working with PropHive has transformed our business operations."</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img src="{{ asset('image/randomdudea1.jpg') }}" alt="Client B Logo" class="testimonial-logo">
                    <div class="testimonial-content">
                        <h3>Client B</h3>
                        <p class="testimonial-source">Manager, Company B</p>
                        <p class="testimonial-quote">"Their expertise and knowledge were invaluable to our success."</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img src="{{ asset('image/mappaceo.jpg') }}" alt="Client C Logo" class="testimonial-logo">
                    <div class="testimonial-content">
                        <h3>Client C</h3>
                        <p class="testimonial-source">Director, Company C</p>
                        <p class="testimonial-quote">"We trust them completely with our projects."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
