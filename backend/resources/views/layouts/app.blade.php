<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PropHive Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="antialiased">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="main-container">
        <header class="header">
            <div class="header-left">
                <img src="{{ asset('images/logo.jpg') }}" alt="PropHive Logo" class="logo">
                <span class="logo-text">PropHive</span>
            </div>
            <div class="header-right">
                <div class="user-menu">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                    <div class="user-avatar-container">
                        <img src="{{ asset('images/avatar.png') }}" alt="User Avatar" class="user-avatar">
                    </div>
                </div>
            </div>
        </header>
        <div class="content-wrapper">
            <aside class="sidebar">
                <nav>
                    <ul>
                        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                        <li><a href="{{ route('payment.index') }}" class="{{ request()->routeIs('payment.*') ? 'active' : '' }}">Payment Management</a></li>
                        <li><a href="{{ route('utility.index') }}" class="{{ request()->routeIs('utility.*') ? 'active' : '' }}">Utility Management</a></li>
                        <li><a href="{{ route('tenant.index') }}" class="{{ request()->routeIs('tenant.*') ? 'active' : '' }}">Tenant Management</a></li>
                        <li><a href="{{ route('property.index') }}" class="{{ request()->routeIs('property.*') ? 'active' : '' }}">Property Management</a></li>
                        <li><a href="{{ route('ticket.index') }}" class="{{ request()->routeIs('ticket.*') ? 'active' : '' }}">Ticket Management</a></li>
                        <li><a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">Property Requests</a></li>
                        <li><a href="{{ route('utility-request.index') }}" class="{{ request()->routeIs('utility-request.*') ? 'active' : '' }}">Utility Request Management</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>