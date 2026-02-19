@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('tenant.index') }}" class="back-button">&#x2190;</a>
        <h1>Edit Tenant</h1>
    </div>

    <div class="edit-layout-container">
        <div class="edit-info-panel">
            <img src="{{ asset('images/avatar.png') }}" class="edit-info-avatar" alt="Tenant Avatar">
            <h2>{{ $tenant->user_name }}</h2>
            <p>Update the profile details using the form on the right.</p>
        </div>

        <div class="edit-form-panel">
            @if (session('success'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form action="{{ route('tenant.update', $tenant->user_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group"><label>Tenant Name</label><input type="text" name="user_name" value="{{ old('user_name', $tenant->user_name) }}"></div>
                <div class="form-group"><label>Email</label><input type="email" name="user_email" value="{{ old('user_email', $tenant->user_email) }}"></div>
                <div class="form-group"><label>Phone Number</label><input type="text" name="user_phone" value="{{ old('user_phone', $tenant->user_phone) }}"></div>
                <div class="form-group"><label>New Password <small>(leave blank to keep current)</small></label><input type="password" name="user_password" placeholder="Enter new password"></div>
                <div class="form-group">
                    <label>Assign to Property/Unit</label>
                    <select name="property_id" class="form-control">
                        <option value="">Select a property</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}" @if($property->tenant_id == $tenant->user_id) selected @endif>
                                {{ $property->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="window.location='{{ route('tenant.index') }}'">Cancel</button>
                    <button type="submit" class="btn btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection