@extends('layouts.app')

@section('title', 'About Us - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
@endpush

@section('content')
    <section class="about-hero">
        <div class="container text-center">
            <h2>About Us</h2>
            <p>A group of passionate individuals dedicated to excellence.</p>
        </div>
    </section>

    <section class="about-content">
        <div class="container">
            <h2 class="content-title">PropHive</h2>
            <div class="about-text">
                <p>
                    Here are the key players behind our success. PropHive is a modern, tech-driven property management solution designed to simplify and elevate real estate operations for owners, tenants, and managers alike. With a focus on efficiency, transparency, and user-friendly interfaces, PropHive bridges the gap between traditional property oversight and smart automation.
                </p>
                <p>
                    At its core, PropHive offers tools for rent collection, maintenance tracking, lease management, and communication—all in one streamlined platform. Property owners benefit from real-time financial performance tracking, while tenants enjoy hassle-free reporting, automated reminders, and seamless digital payments.
                </p>
                <p>
                    We've also designed it with scalability. Whether managing a single unit or a large portfolio of properties, the system scales effortlessly, ensuring consistent quality and control. Security and data privacy are also top priorities, with robust encryption and cloud-based storage ensuring your information is safe.
                </p>
                <p>
                    PropHive isn't just software—it's a smarter way to manage property. By reducing manual tasks and improving responsiveness, PropHive empowers users to focus on growth and tenant satisfaction, making property management more proactive, professional, and profitable.
                </p>
            </div>
            <div class="about-gallery">
                <img src="{{ asset('image/house.png') }}" alt="Image of a modern house">
                <img src="{{ asset('image/apartment.png') }}" alt="Image of a modern apartment interior">
                <img src="{{ asset('image/famhouse.png') }}" alt="Image of a cozy living room">
            </div>
        </div>
    </section>
@endsection
