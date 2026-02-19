@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('property.index') }}" class="back-button">&#x2190;</a>
        <h1>Current Properties</h1>
        <p>List of properties currently available.</p>
    </div>
    <div class="property-list-grid">
        @foreach($properties as $property)
        <div class="property-list-card">
            <img src="{{ $property->images ? asset('storage/' . $property->images) : asset('images/house.jpeg') }}" alt="Property Image" class="property-list-image">
            <div class="property-list-details">
                <h3>{{ $property->title }}</h3>
                <p>{{ Str::limit($property->description, 120) }}</p>
                <p><strong>Type:</strong> {{ $property->type }}</p>
                <p><strong>Status:</strong> {{ $property->status }}</p>
                <p><strong>Bedrooms:</strong> {{ $property->bedrooms }}</p>
                <p><strong>Bathrooms:</strong> {{ $property->bathrooms }}</p>
                <p><strong>Square Feet:</strong> {{ $property->square_feet }}</p>
                <p><strong>Address:</strong> {{ $property->address }}</p>
                <p><strong>Features:</strong> {{ $property->features }}</p>
            </div>
            <div class="property-list-actions">
                <a href="{{ route('property.edit', $property) }}"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="action-icon"></a>
                 <form action="{{ route('property.destroy', $property) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" style="border:none;background:none;padding:0;cursor:pointer;"><img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="action-icon"></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection