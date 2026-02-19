<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# PropHive - Laravel Real Estate Platform

A modern real estate platform built with Laravel and Blade templating.

## 🚀 Features

- **Modern Laravel Structure**: Proper MVC architecture with controllers and models
- **Blade Templating**: Reusable components and layouts
- **Authentication System**: User registration, login, and logout
- **Contact Form**: Functional contact form with validation
- **Responsive Design**: Mobile-friendly interface
- **Component-Based**: Reusable UI components

## 📁 Project Structure

```
mission727/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # Authentication logic
│   │   ├── ContactController.php   # Contact form handling
│   │   └── PageController.php      # Static page handling
│   └── Models/
│       └── User.php                # User model
├── resources/
│   └── views/
│       ├── components/             # Reusable Blade components
│       │   ├── property-card.blade.php
│       │   ├── service-card.blade.php
│       │   └── testimonial-card.blade.php
│       ├── layouts/
│       │   └── app.blade.php       # Main layout template
│       ├── homepage.blade.php      # Home page
│       ├── login.blade.php         # Login page
│       ├── register.blade.php      # Registration page
│       └── ...                     # Other pages
├── routes/
│   └── web.php                     # Application routes
└── public/
    ├── css/                        # Stylesheets
    └── image/                      # Images
```

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd mission727
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🎨 Blade Components

### Layout System
- **Main Layout**: `resources/views/layouts/app.blade.php`
  - Contains header, footer, and navigation
  - Uses `@yield('content')` for page content
  - Supports `@stack('styles')` for page-specific CSS

### Reusable Components
- **Service Card**: `<x-service-card image="..." title="..." description="..." />`
- **Property Card**: `<x-property-card image="..." title="..." price="..." />`
- **Testimonial Card**: `<x-testimonial-card image="..." name="..." testimonial="..." />`

### Page Structure
Each page follows this pattern:
```blade
@extends('layouts.app')

@section('title', 'Page Title')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-specific.css') }}">
@endpush

@section('content')
    <!-- Page content here -->
@endsection
```

## 🔐 Authentication

The application includes a complete authentication system:

- **Login**: `/login` - User login with email and password
- **Register**: `/register` - User registration
- **Logout**: Automatic logout functionality
- **Session Management**: Secure session handling

### Authentication Features
- Form validation with error messages
- Remember me functionality
- Password confirmation for registration
- CSRF protection
- Secure password hashing

## 📧 Contact Form

The contact form includes:
- Form validation
- Success/error messages
- CSRF protection
- Input sanitization

## 🎯 Key Improvements Made

### 1. **Proper Laravel Structure**
- Moved from inline routes to controllers
- Organized code into proper MVC pattern
- Added proper namespacing

### 2. **Blade Templating**
- Created reusable layout system
- Built component-based architecture
- Implemented proper asset handling with `{{ asset() }}`

### 3. **Route Management**
- Named routes for better navigation
- Organized routes by functionality
- Added proper route parameters

### 4. **Form Handling**
- CSRF protection on all forms
- Form validation with error display
- Old input preservation on validation errors

### 5. **Authentication System**
- Complete user registration and login
- Session management
- Password hashing and security

## 🔄 Converting Remaining Pages

To convert the remaining pages to use the new layout:

1. **Replace HTML structure** with `@extends('layouts.app')`
2. **Add page title** with `@section('title', 'Page Title')`
3. **Add page-specific styles** with `@push('styles')`
4. **Wrap content** in `@section('content') ... @endsection`
5. **Remove header/footer** (now in layout)
6. **Update image paths** to use `{{ asset() }}`
7. **Update links** to use `{{ route() }}`

## 🚀 Usage

### Creating New Pages
1. Create a new Blade file in `resources/views/`
2. Extend the main layout
3. Add the route in `routes/web.php`
4. Add the controller method if needed

### Adding New Components
1. Create component file in `resources/views/components/`
2. Use `<x-component-name>` syntax in views
3. Pass parameters as attributes

### Styling
- Main styles: `public/css/style.css`
- Page-specific styles: `public/css/page-name.css`
- Use `@push('styles')` for page-specific CSS

## 📝 Notes

- All images should use `{{ asset('image/filename.jpg') }}`
- All links should use `{{ route('route-name') }}`
- Forms should include `@csrf` directive
- Use `{{ old('field-name') }}` to preserve form data on validation errors

## 🔧 Development

To continue development:
1. Follow Laravel conventions
2. Use Blade components for reusable UI elements
3. Implement proper form validation
4. Add database migrations for new features
5. Use Laravel's built-in security features

---

**PropHive** - Making real estate management simple and efficient.
