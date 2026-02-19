<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Log;

// If the user is logged in, go to the dashboard. Otherwise, show the login page.
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
});

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Utility Management
    Route::get('/utility-management', [UtilityController::class, 'index'])->name('utility.index');
    Route::post('/utility-management', [UtilityController::class, 'store'])->name('utility.store');
    Route::get('/utility-management/{utilityBill}/edit', [UtilityController::class, 'edit'])->name('utility.edit');
    Route::put('/utility-management/{utilityBill}', [UtilityController::class, 'update'])->name('utility.update');
    Route::delete('/utility-management/{utilityBill}', [UtilityController::class, 'destroy'])->name('utility.destroy');

    // Payment Management
    Route::get('/payment-management', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment-management', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment-management/{payment}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::put('/payment-management/{payment}', [PaymentController::class, 'update'])->name('payment.update');
    Route::delete('/payment-management/{payment}', [PaymentController::class, 'destroy'])->name('payment.destroy');

    // Tenant Management
    Route::get('/tenant-management', [TenantController::class, 'index'])->name('tenant.index');
    Route::get('/tenant-management/create', [TenantController::class, 'create'])->name('tenant.create');
    Route::post('/tenant-management', [TenantController::class, 'store'])->name('tenant.store');
    Route::get('/tenant-management/{user}/edit', [TenantController::class, 'edit'])->name('tenant.edit');
    Route::put('/tenant-management/{user}', [TenantController::class, 'update'])->name('tenant.update');
    Route::delete('/tenant-management/{user}', [TenantController::class, 'destroy'])->name('tenant.destroy');

    // Property Management
    Route::get('/property-management', [PropertyController::class, 'index'])->name('property.index');
    Route::post('/property-management', [PropertyController::class, 'store'])->name('property.store');
    Route::get('/property-management/list', [PropertyController::class, 'listAll'])->name('property.list');
    Route::get('/property-management/{property}/edit', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/property-management/{property}', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/property-management/{property}', [PropertyController::class, 'destroy'])->name('property.destroy');

    // Ticket Management
    Route::get('/ticket-management', [App\Http\Controllers\TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket-management/{ticket}/edit', [App\Http\Controllers\TicketController::class, 'edit'])->name('ticket.edit');
    Route::put('/ticket-management/{ticket}', [App\Http\Controllers\TicketController::class, 'update'])->name('ticket.update');
    Route::delete('/ticket-management/{ticket}', [App\Http\Controllers\TicketController::class, 'destroy'])->name('ticket.destroy');

    // Property Request Management (Contact)
    Route::get('/property-requests', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
    Route::get('/property-requests/{contact}/edit', [App\Http\Controllers\ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/property-requests/{contact}', [App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');
    Route::delete('/property-requests/{contact}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');

    // Utility Request Management
    Route::get('/utility-requests', [App\Http\Controllers\UtilityRequestController::class, 'index'])->name('utility-request.index');
    Route::get('/utility-requests/{id}/edit', [App\Http\Controllers\UtilityRequestController::class, 'edit'])->name('utility-request.edit');
    Route::put('/utility-requests/{id}', [App\Http\Controllers\UtilityRequestController::class, 'update'])->name('utility-request.update');
    Route::delete('/utility-requests/{id}', [App\Http\Controllers\UtilityRequestController::class, 'destroy'])->name('utility-request.destroy');

    // Logout route
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});

// Guest-only routes (only for unauthenticated users)
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
});