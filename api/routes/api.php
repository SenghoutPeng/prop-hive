<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\BackEndController\DashboardController;
use App\Http\Controllers\BackEndController\PaymentController;
use App\Http\Controllers\BackEndController\PropertyController;
use App\Http\Controllers\BackEndController\TenantController;
use App\Http\Controllers\BackEndController\UtilityController;
use App\Http\Controllers\BackEndController\TicketController;
use App\Http\Controllers\BackEndController\ContactController as BackEndContactController;
use App\Http\Controllers\BackEndController\UtilityRequestController;
use App\Http\Controllers\BackEndController\AuthController as BackEndAuthController;
use App\Http\Controllers\FrontEndController\PageController;
use App\Http\Controllers\FrontEndController\ContactController as FrontEndContactController;
use App\Http\Controllers\FrontEndController\AuthController as FrontEndAuthController;
use App\Http\Controllers\FrontEndController\SupportTicketController;
use Illuminate\Support\Facades\Log;

// API Routes - All responses will be JSON

// Frontend Routes (Public/User Access)
    // Public authentication routes
    Route::post('/user/login', [FrontEndAuthController::class, 'login']);
    Route::post('/register', [FrontEndAuthController::class, 'register']);
    Route::post('/user/logout', [FrontEndAuthController::class, 'logout']);

    // Public API routes (no authentication required)
    Route::post('/contact', [FrontEndContactController::class, 'submit']);
    Route::post('/utility-request', [UtilityRequestController::class, 'store']);
    Route::post('/support-ticket', [TicketController::class, 'store']);

    // Public page routes
    Route::get('/home', [PageController::class, 'home']);
    Route::get('/about', [PageController::class, 'about']);
    Route::get('/contact', [PageController::class, 'contact']);
    Route::get('/listing', [PageController::class, 'listing']);
    Route::get('/meet-our-team', [PageController::class, 'meetOurTeam']);
    Route::get('/our-client', [PageController::class, 'ourClient']);
    Route::get('/edit-tenant', [PageController::class, 'editTenant']);
    Route::get('/property-details/{id}', [PageController::class, 'propertyDetails']);
    Route::get('/property-overview', [PageController::class, 'propertyOverview']);

    // Protected Frontend Routes (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        // User profile routes
        Route::get('/profile', [PageController::class, 'profile']);
        Route::put('/profile', [PageController::class, 'updateProfile']);
        // User-specific data
        Route::get('/payment-history', [PageController::class, 'paymentHistory']);
        Route::get('/my-support-tickets', [SupportTicketController::class, 'index']);
        Route::post('/my-support-tickets', [SupportTicketController::class, 'store']);
        Route::get('/my-support-tickets/{id}', [SupportTicketController::class, 'show']);
        // User utility requests
        Route::post('/my-utility-request', [PageController::class, 'storeUtilityRequest']);
        // User descriptions
        Route::post('/description', [PageController::class, 'descrip']);
    });

// Admin authentication and login redirect routes (remain outside frontend group)
Route::post('/admin/login', [BackEndAuthController::class, 'login']);
Route::get('/login', function () {
    return response()->json([
        'message' => 'Please login to access this resource',
        'user_login_url' => '/api/frontend/user/login',
        'admin_login_url' => '/api/admin/login'
    ], 401);
})->name('login');


// Backend Routes (Admin/Management)
// Protected API routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Admin logout route
    Route::post('/admin/logout', [BackEndAuthController::class, 'logout']);

    // Dashboard API
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Utility Management API
    Route::get('/utilities', [UtilityController::class, 'index']);
    Route::post('/utilities', [UtilityController::class, 'store']);
    Route::get('/utilities/{id}', [UtilityController::class, 'show']);
    Route::put('/utilities/{id}', [UtilityController::class, 'update']);
    Route::delete('/utilities/{id}', [UtilityController::class, 'destroy']);
    
    // Payment Management API
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::get('/payments/{payment}', [PaymentController::class, 'show']);
    Route::put('/payments/{payment}', [PaymentController::class, 'update']);
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy']);
    
    // Tenant Management API
    Route::get('/tenants', [TenantController::class, 'index']);
    Route::post('/tenants', [TenantController::class, 'store']);
    Route::get('/tenants/{user}', [TenantController::class, 'show']);
    Route::put('/tenants/{user}', [TenantController::class, 'update']);
    Route::delete('/tenants/{user}', [TenantController::class, 'destroy']);
    
    // Property Management API
    Route::get('/properties', [PropertyController::class, 'index']);
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::get('/properties/{property}', [PropertyController::class, 'show']);
    Route::put('/properties/{property}', [PropertyController::class, 'update']);
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy']);
    
    // Ticket Management API
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::get('/tickets/{ticket}', [TicketController::class, 'show']);
    Route::put('/tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);
    
    // Contact/Property Requests API
    Route::get('/contacts', [BackEndContactController::class, 'index']);
    Route::get('/contacts/{contact}', [BackEndContactController::class, 'show']);
    Route::put('/contacts/{contact}', [BackEndContactController::class, 'update']);
    Route::delete('/contacts/{contact}', [BackEndContactController::class, 'destroy']);
    
    // Utility Request Management API
    Route::get('/utility-requests', [UtilityRequestController::class, 'index']);
    Route::get('/utility-requests/{id}', [UtilityRequestController::class, 'show']);
    Route::put('/utility-requests/{id}', [UtilityRequestController::class, 'update']);
    Route::delete('/utility-requests/{id}', [UtilityRequestController::class, 'destroy']);
});
