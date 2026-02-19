@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('property.index') }}" class="back-button">&#x2190;</a>
        <h1>Edit Property Details</h1>
    </div>
    <div class="form-card-full">
        @if ($errors->any()) <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div> @endif
        <form action="{{ route('property.update', $property) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-grid-col-2">
                <div class="form-group"><label>Property Name</label><input type="text" name="title" value="{{ old('title', $property->title) }}"></div>
                <div class="form-group"><label>Price</label><input type="text" name="price" value="{{ old('price', $property->price) }}"></div>
                <div class="form-group"><label>Type</label><input type="text" name="type" value="{{ old('type', $property->type) }}"></div>
                <div class="form-group"><label>Status</label><input type="text" name="status" value="{{ old('status', $property->status) }}"></div>
                <div class="form-group"><label>Bedrooms</label><input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}"></div>
                <div class="form-group"><label>Bathrooms</label><input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}"></div>
                <div class="form-group"><label>Square Feet</label><input type="number" name="square_feet" value="{{ old('square_feet', $property->square_feet) }}"></div>
                <div class="form-group"><label>Address</label><input type="text" name="address" value="{{ old('address', $property->address) }}"></div>
                <div class="form-group form-span-2"><label>Features</label><textarea name="features" rows="2">{{ old('features', $property->features) }}</textarea></div>
                <div class="form-group form-span-2"><label>Description</label><textarea name="description" rows="3">{{ old('description', $property->description) }}</textarea></div>
                <div class="form-group form-span-2"><label>Upload New Image</label><input type="file" name="images" class="form-control"></div>
                @if($property->images)
                <div class="form-group form-span-2">
                    <label>Current Image:</label><br>
                    <img src="{{ asset('storage/' . $property->images) }}" alt="Property Image" style="max-width: 200px;">
                </div>
                @else
                <div class="form-group form-span-2">
                    <label>Current Image:</label><br>
                    <img src="{{ asset('images/placeholder.jpg') }}" alt="No Image" style="max-width: 200px;">
                </div>
                @endif
            </div>
            <div class="form-actions-center"><button type="submit" class="btn btn-save">Save Edit</button></div>
        </form>
    </div>
</div>
@endsection