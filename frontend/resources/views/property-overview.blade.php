@extends('layouts.app')

@section('title', 'Property Overview - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/property-overview.css') }}">
@endpush

@section('content')
    <main class="property-overview-page">
        <div class="container">
            <section class="overview-header modern-card">
                <div class="overview-header-flex">
                    <div class="overview-main-info">
                        <h2>Property Overview</h2>
                        <p class="subtitle">Manage your property efficiently with our detailed dashboard.</p>
                        <div class="property-info-block">
                            <h3>{{ $property->title ?? 'No Property Found' }}</h3>
                            <p class="property-address">{{ $property->address ?? '' }}</p>
                            <div class="property-price">{{ $property->formatted_price ?? '' }}</div>
                            <ul class="property-features-list">
                                <li><strong>Type:</strong> {{ $property->type ?? '' }}</li>
                                <li><strong>Bedrooms:</strong> {{ $property->bedrooms ?? '' }}</li>
                                <li><strong>Bathrooms:</strong> {{ $property->bathrooms ?? '' }}</li>
                                <li><strong>Size:</strong> {{ $property->square_feet ?? '' }} sq ft</li>
                            </ul>
                            <a href="{{ route('payment-history') }}" class="btn btn-modern" style="margin-top:1.2rem;display:inline-block;">View History</a>
                        </div>
                    </div>
                    <div class="overview-image-block">
                        @if($property && $property->main_image)
                            <img src="{{ asset('image/' . $property->main_image) }}" alt="{{ $property->title }}" class="overview-main-image">
                        @else
                            <img src="{{ asset('image/BIG villa.png') }}" alt="Default Property" class="overview-main-image">
                        @endif
                        <div class="overview-map-block" style="margin-top:1.5rem;">
                            <img src="{{ asset('image/mappa.jpg') }}" alt="Phnom Penh Map" style="max-width:100%; border-radius:12px;">
                        </div>
                    </div>
                </div>
            </section>

            <section class="utility-section modern-card">
                <h2 class="section-title">Utility Usage Overview</h2>
                <p class="section-subtitle">Track electricity and water usage metrics.</p>
                <div class="utility-grid">
                    <div class="utility-card">
                        <label>Electricity Bill</label>
                        <p class="amount">$120</p>
                        <p class="change increase">+5%</p>
                    </div>
                    <div class="utility-card">
                        <label>Water Bill</label>
                        <p class="amount">$45</p>
                        <p class="change decrease">-2%</p>
                    </div>
                    <div class="utility-card">
                        <label>Electricity Usage</label>
                        <p class="amount">350 KWH</p>
                        <p class="change increase">+10%</p>
                    </div>
                    <div class="utility-card">
                        <label>Water Usage</label>
                        <p class="amount">200 cubic meter</p>
                        <p class="change decrease">-1%</p>
                    </div>
                </div>
            </section>

            <section class="utility-section modern-card">
                <h2 class="section-title">Utility Requests</h2>
                <p class="section-subtitle">Your submitted utility requests:</p>
                <div class="utility-grid">
                    @forelse($utilityRequests as $request)
                        <div class="utility-card">
                            <p class="amount">{{ $request->utility_request_description }}</p>
                            <p class="change">Status: {{ $request->utility_request_status }}</p>
                        </div>
                    @empty
                        <p>No utility requests found.</p>
                    @endforelse
                </div>
            </section>

            <section class="submit-request-section modern-card">
                <div class="request-title-column">
                    <h2 class="section-title">Submit Utility Requests</h2>
                    <p class="section-subtitle">Report issues regarding electricity or water.</p>
                </div>
                <div class="request-form-column">
                    <form action="{{ route('utility-request.store') }}" method="POST" class="request-form">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="property_id" value="{{ $property->id ?? '' }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" placeholder="Describe the issue..." required>
                        </div>
                        <button type="submit" class="btn-submit">Submit Request</button>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
