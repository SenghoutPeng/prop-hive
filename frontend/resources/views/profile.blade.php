@extends('layouts.app')

@section('title', 'Profile - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@section('content')
    <section class="profile-hero">
        <div class="container">
            <h1>My Profile</h1>
            <p>Manage your account settings and preferences</p>
        </div>
    </section>

    <section class="profile-content">
        <div class="container">
            <div class="profile-grid">
                <!-- Profile Information -->
                <div class="profile-section animate-on-scroll">
                    <h2>Profile Information</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form class="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" data-validate="true">
                        @csrf
                        <div class="avatar-section">
                            @if($user && $user->user_profile_picture)
                                <img src="/{{ $user->user_profile_picture }}" alt="Profile Avatar" class="avatar-preview" id="avatarPreview">
                            @else
                                <img src="{{ asset('image/teto.jpg') }}" alt="Profile Avatar" class="avatar-preview" id="avatarPreview">
                            @endif
                            <input type="file" class="avatar-input" accept="image/*" id="avatarInput" name="avatar" style="display:none;">
                            <label for="avatarInput" class="avatar-upload-btn">Change Photo</label>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">Full Name *</label>
                                <input type="text" id="first_name" name="first_name" value="{{ $user ? $user->user_name : '' }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ $user ? $user->user_email : '' }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ $user ? $user->user_phone : '' }}">
                        </div>
                        
                        <!-- Address field removed -->
                        
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>

                <!-- Account Statistics -->
                <div class="profile-section animate-on-scroll">
                    <h2>Account Statistics</h2>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-target="5">0</h3>
                                <p>Properties Viewed</p>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-target="3">0</h3>
                                <p>Favorites</p>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-target="2">0</h3>
                                <p>Viewings Scheduled</p>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-target="8">0</h3>
                                <p>Messages Sent</p>
                            </div>
                        </div>
                    </div>
                    <!-- Modern action buttons below statistics -->
                    <div class="modern-action-buttons" style="display: flex; gap: 1.5rem; margin-top: 2rem; justify-content: center;">
                        <a href="{{ route('property-overview') }}" class="btn btn-modern">
                            <i class="fas fa-cogs"></i> Utility
                        </a>
                        <a href="{{ route('payment-history') }}" class="btn btn-modern">
                            <i class="fas fa-credit-card"></i> Payment History
                        </a>
                        <a href="{{ route('support-tickets.index') }}" class="btn btn-modern">
                            <i class="fas fa-ticket-alt"></i> Support Tickets
                        </a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-modern" style="background: #dc3545;">
                            <i class="fas fa-sign-out-alt"></i> Sign Out
                        </button>
                    </form>
                    </div>
                </div>

                <!-- Preferences -->
                <div class="profile-section animate-on-scroll">
                    <h2>Preferences</h2>
                    <div class="preferences-list">
                        <div class="preference-item">
                            <label class="checkbox-label">
                                <input type="checkbox" class="preference-toggle" name="email_notifications" checked>
                                <span class="checkmark"></span>
                                Email Notifications
                            </label>
                        </div>
                        
                        <div class="preference-item">
                            <label class="checkbox-label">
                                <input type="checkbox" class="preference-toggle" name="sms_notifications">
                                <span class="checkmark"></span>
                                SMS Notifications
                            </label>
                        </div>
                        
                        <div class="preference-item">
                            <label class="checkbox-label">
                                <input type="checkbox" class="preference-toggle" name="property_alerts" checked>
                                <span class="checkmark"></span>
                                New Property Alerts
                            </label>
                        </div>
                        
                        <div class="preference-item">
                            <label class="checkbox-label">
                                <input type="checkbox" class="preference-toggle" name="market_updates">
                                <span class="checkmark"></span>
                                Market Updates
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div class="profile-section animate-on-scroll">
                    <h2>Notification Settings</h2>
                    <div class="notification-settings">
                        <div class="notification-item">
                            <div class="notification-info">
                                <h4>Property Viewings</h4>
                                <p>Get notified about upcoming property viewings</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" class="notification-setting" data-type="viewings" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="notification-item">
                            <div class="notification-info">
                                <h4>Price Changes</h4>
                                <p>Receive alerts when property prices change</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" class="notification-setting" data-type="price_changes" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="notification-item">
                            <div class="notification-info">
                                <h4>New Listings</h4>
                                <p>Get notified about new properties matching your criteria</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" class="notification-setting" data-type="new_listings">
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="notification-item">
                            <div class="notification-info">
                                <h4>Agent Messages</h4>
                                <p>Receive notifications when agents send you messages</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" class="notification-setting" data-type="agent_messages" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('avatarInput');
            const preview = document.getElementById('avatarPreview');
            if (input && preview) {
                input.addEventListener('change', function(e) {
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(ev) {
                            preview.src = ev.target.result;
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                });
            }
        });
    </script>
@endpush
