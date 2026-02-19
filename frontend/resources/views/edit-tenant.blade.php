@extends('layouts.app')

@section('title', 'Edit Tenant - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/edit-tenant.css') }}">
@endpush

@section('content')
    <main class="edit-tenant-page">
        <div class="container">
            <section class="edit-header">
                <div class="user-details">
                    <img src="{{ asset('image/teto.jpg') }}" alt="Tenant Avatar" class="avatar">
                    <div class="user-info">
                        <h2>Kasane Teto</h2>
                        <p><span class="status-badge">Active</span> Tenant since 1/2020</p>
                        <p class="view-description">Editing tenant details for a comprehensive view.</p>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-cancel">Cancel</button>
                    <button class="btn btn-save">Save Changes</button>
                </div>
            </section>

            <section class="main-form-area">
                <div class="form-title-column">
                    <h3>Tenant Details</h3>
                    <p>Please update the tenant information below.</p>
                </div>
                <div class="form-fields-column">
                    <form action="#" class="tenant-form">
                        <div class="form-group">
                            <label for="full-name">Full Name</label>
                            <input type="text" id="full-name" placeholder="Enter tenant's full name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Enter tenant's email address">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" placeholder="Enter tenant's phone number">
                        </div>
                        <div class="form-group">
                            <label for="lease-start">Lease Start Date</label>
                            <input type="date" id="lease-start" placeholder="Select start date">
                        </div>
                        <div class="form-group">
                            <label for="lease-end">Lease End Date</label>
                            <input type="date" id="lease-end" placeholder="Select end date">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="status-selector">
                                <button type="button" class="btn-status active">Active</button>
                                <button type="button" class="btn-status">Pending</button>
                                <button type="button" class="btn-status">Inactive</button>
                            </div>
                        </div>
                        <button type="submit" class="btn-update">Update Tenant</button>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
