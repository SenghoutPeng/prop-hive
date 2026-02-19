@extends('layouts.app')

@section('title', 'Contact Us - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
    <style>
        .contact-hero {
            margin-bottom: 2.5rem;
        }
        .contact-info-section {
            max-width: 600px;
            margin: 2.5rem auto 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.08);
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .contact-info-section h2 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1.2rem;
        }
        .contact-info-section ul {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
        }
        .contact-info-section li {
            margin-bottom: 0.7rem;
            font-size: 1.08rem;
        }
        .send-ticket-btn {
            display: inline-block;
            padding: 1rem 2.2rem;
            background: #eab308;
            color: #222;
            font-size: 1.15rem;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: background 0.2s, box-shadow 0.2s;
            text-decoration: none;
            margin-top: 1.2rem;
        }
        .send-ticket-btn:hover {
            background: #c59d07;
            color: #222;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
    </style>
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
        <ul>
            <li><strong>Address</strong><br>123 Main Street<br>Phnom Penh, Cambodia</li>
            <li><strong>Phone</strong><br>+855 12 345 678</li>
            <li><strong>Email</strong><br>info@prophive.com</li>
            <li><strong>Business Hours</strong><br>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 4:00 PM</li>
        </ul>
        <a href="{{ url('/support-tickets/create') }}" class="send-ticket-btn">Send a Ticket</a>
    </section>
@endsection
