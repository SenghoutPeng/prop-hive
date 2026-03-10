@extends('layouts.app')

@section('title', 'Contact Us - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
@endpush

@section('content')
    <section class="contact-hero">
        <div class="container">
            <h1>Contact Us</h1>
            <p>We're here to help! Reach out to our team for any inquiries or support needs.</p>
        </div>
    </section>
    <section class="contact-info-section">
        <h2>Get in Touch</h2>
        <ul class="contact-info-list">
            <li><strong>Address</strong><br>123 Main Street<br>Phnom Penh, Cambodia</li>
            <li><strong>Phone</strong><br>+855 12 345 678</li>
            <li><strong>Email</strong><br>info@prophive.com</li>
            <li><strong>Business Hours</strong><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 4:00 PM</li>
        </ul>
        <a href="{{ url('/support-tickets/create') }}" class="send-ticket-btn">Send a Ticket</a>
    </section>
@endsection
