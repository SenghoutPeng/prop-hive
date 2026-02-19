@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('tenant.index') }}" class="back-button">&#x2190;</a>
        <h1>Add New Tenant</h1>
    </div>

    <div class="edit-layout-container">
        <div class="edit-info-panel">
            <img src="{{ asset('images/avatar.png') }}" class="edit-info-avatar" alt="Tenant Avatar">
            <h2>New Tenant Profile</h2>
            <p>Fill in the details of the new tenant on the right.</p>
        </div>

        <div class="edit-form-panel">
            @if ($errors->any())
                <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form action="{{ route('tenant.store') }}" method="POST">
                @csrf
                <div class="form-group"><label>Tenant Name</label><input type="text" name="user_name" placeholder="Enter tenant's name" value="{{ old('user_name') }}"></div>
                <div class="form-group"><label>Email</label><input type="email" name="user_email" placeholder="Enter tenant's email" value="{{ old('user_email') }}"></div>
                <div class="form-group"><label>Password</label><input type="password" name="user_password" placeholder="Enter password" required></div>
                <div class="form-group"><label>Phone Number</label><input type="text" name="user_phone" placeholder="Enter phone number" value="{{ old('user_phone') }}"></div>
                <div class="form-group">
                    <label>Assign to Property/Unit</label>
                    <select name="property_id" class="form-control">
                        <option value="">Select a property</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}">{{ $property->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group"><label>Lease Start Date</label><input type="date" name="property_renting_start_date" value="{{ old('property_renting_start_date') }}"></div>
                <div class="form-group"><label>Lease End Date</label><input type="date" name="property_renting_end_date" value="{{ old('property_renting_end_date') }}"></div>

                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="window.location='{{ route('tenant.index') }}'">Cancel</button>
                    <button type="submit" class="btn btn-save">Add Tenant</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection