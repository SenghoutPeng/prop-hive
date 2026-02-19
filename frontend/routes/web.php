<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupportTicketController;

// Home page
Route::get('/', [PageController::class, 'home'])->name('home');

// Static pages
Route::get('/about-us', [PageController::class, 'about'])->name('about-us');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact-us');
Route::get('/listing', [PageController::class, 'listing'])->name('listing');
Route::get('/meet-our-team', [PageController::class, 'meetOurTeam'])->name('meet-our-team');
Route::get('/our-client', [PageController::class, 'ourClient'])->name('our-client');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/property-overview', [PageController::class, 'propertyOverview'])->name('property-overview');
Route::get('/property-details/{id}', [PageController::class, 'propertyDetails'])->name('property-details');

// Authentication pages
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');

// Property management pages
Route::get('/payment-history', [PageController::class, 'paymentHistory'])->name('payment-history');
Route::get('/edit-tenant', [PageController::class, 'editTenant'])->name('edit-tenant');

// Contact form
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');

// Support Ticket routes (require authentication for viewing, but not for creating)
Route::get('/support-tickets/create', [SupportTicketController::class, 'create'])->name('support-tickets.create');
Route::post('/support-tickets', [SupportTicketController::class, 'store'])->name('support-tickets.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/support-tickets', [SupportTicketController::class, 'index'])->name('support-tickets.index');
    Route::get('/support-tickets/{id}', [SupportTicketController::class, 'show'])->name('support-tickets.show');
});

// Admin support ticket routes (can be protected with admin middleware later)
Route::prefix('admin')->group(function () {
    Route::get('/support-tickets', [SupportTicketController::class, 'adminIndex'])->name('admin.support-tickets.index');
    Route::get('/support-tickets/{id}', [SupportTicketController::class, 'adminShow'])->name('admin.support-tickets.show');
    Route::patch('/support-tickets/{id}/status', [SupportTicketController::class, 'updateStatus'])->name('admin.support-tickets.update-status');
});

// Authentication routes
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

//description

// Utility request
Route::post('/utility-request', [PageController::class, 'storeUtilityRequest'])->name('utility-request.store');

// New route for updating the user profile
Route::post('/profile', [PageController::class, 'updateProfile'])->name('profile.update');

// Debug route for test form
Route::view('/test-form', 'test-form');
