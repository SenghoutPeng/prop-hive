<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PropHive - Real Estate Platform')</title>
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Page-specific styles -->
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('image/photo_6141044952965170157_y.jpg') }}" alt="PropHive Logo" class="logo">
                <h1>PropHive</h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/listing">Listings</a></li>
                    <li><a href="/about-us">About Us</a></li>
                    <li><a href="/meet-our-team">Meet Our Team</a></li>
                    <li><a href="/our-client">Our Client</a></li>
                    <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                </ul>
            </nav>
            <div class="user-actions">
                @guest
                    <a href="/login" class="login-btn">Login</a>
                @endguest
                @auth
                    <a href="/profile" class="profile-icon">
                        @php $profilePic = auth()->user()->user_profile_picture ?? null; @endphp
                        @if($profilePic)
                            <img src="/{{ $profilePic }}" alt="Profile">
                        @else
                            <img src="{{ asset('image/teto.jpg') }}" alt="Profile">
                        @endif
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 1rem; margin: 1rem; border-radius: 5px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error" style="background: #f8d7da; color: #721c24; padding: 1rem; margin: 1rem; border-radius: 5px; border: 1px solid #f5c6cb;">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="map-container">
                <img src="{{ asset('image/phnompenh.png') }}" alt="Map of Phnom Penh">
            </div>
            <div class="footer-content">
                <p>Contact Us: contact@example.com</p>
                <div class="social-media">
                    <p>Follow us on social media</p>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                </div>
                <p>&copy; 2025 Real Estate Platform</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html> 