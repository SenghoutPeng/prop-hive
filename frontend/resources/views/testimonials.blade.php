@extends('layouts.app')

@section('title', 'Client Testimonials - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/testimonials.css') }}">
@endpush

@section('content')
    <main class="testimonials-page">
        <div class="container testimonials-container">
            <div class="left-column">
                <h2 class="page-title">Client Testimonials</h2>
                <p class="page-subtitle">Hear what our clients have to say about us.</p>
                <div class="decorative-image-container">
                    <img src="{{ asset('image/pharma.png') }}" alt="Faculty of Pharmacy Building">
                </div>
            </div>

            <div class="right-column">
                <div class="featured-testimonial">
                    <img src="{{ asset('image/medicare.png') }}" alt="Client A Logo" class="testimonial-logo">
                    <div class="testimonial-info">
                        <h3>Client A</h3>
                        <p class="source">CEO, Company A</p>
                    </div>
                </div>
                <div class="testimonial-quote">
                    <p>"Working with PropHive has transformed our business operations."</p>
                </div>
                <div class="testimonial-full-text">
                    <p>
                        We trust them completely with our projects. I recently started using PropHive for managing my rental properties, and I couldn't be more impressed! The platform is incredibly easy to navigate, even for someone like me who's not very tech-savvy. Everything from tracking rent payments to handling maintenance requests has become so much more organized and efficient. I especially love how quickly I can communicate with tenants—no more endless emails or missed messages. The automated reminders are a lifesaver too. What really stood out, though, was the customer support. They were quick, friendly, and super helpful when I had a few questions during setup. Prop Hunt has honestly taken so much stress out of my day-to-day property management. I'd highly recommend it to any landlord or manager looking to simplify their work!
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
