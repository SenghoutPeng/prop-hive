@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Property Details</h1>
        <p>Please provide the information for the new property.</p>
    </div>
    <div class="form-card-full">
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if ($errors->any()) <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div> @endif
        <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid-col-2">
                <div class="form-group"><label>Property Name</label><input type="text" name="title" placeholder="Enter property name" value="{{ old('title') }}"></div>
                <div class="form-group"><label>Price</label><input type="text" name="price" placeholder="Enter property price" value="{{ old('price') }}"></div>
                <div class="form-group"><label>Type</label><input type="text" name="type" placeholder="Enter property type" value="{{ old('type') }}"></div>
                <div class="form-group"><label>Status</label><input type="text" name="status" placeholder="Enter status" value="{{ old('status') }}"></div>
                <div class="form-group"><label>Bedrooms</label><input type="number" name="bedrooms" placeholder="Enter bedrooms" value="{{ old('bedrooms') }}"></div>
                <div class="form-group"><label>Bathrooms</label><input type="number" name="bathrooms" placeholder="Enter bathrooms" value="{{ old('bathrooms') }}"></div>
                <div class="form-group"><label>Square Feet</label><input type="number" name="square_feet" placeholder="Enter square feet" value="{{ old('square_feet') }}"></div>
                <div class="form-group"><label>Address</label><input type="text" name="address" placeholder="Enter property address" value="{{ old('address') }}"></div>
                <div class="form-group form-span-2"><label>Features</label><textarea name="features" rows="2" placeholder="Enter features">{{ old('features') }}</textarea></div>
                <div class="form-group form-span-2"><label>Description</label><textarea name="description" rows="3" placeholder="Provide a detailed description">{{ old('description') }}</textarea></div>
                <div class="form-group form-span-2"><label>Upload Image</label><input type="file" name="images" class="form-control"></div>
            </div>
            <div class="form-actions-center"><button type="submit" class="btn btn-save">Add Property</button></div>
        </form>
    </div>

    <div class="list-container">
        <h2>Current Properties</h2>
        <p>List of properties currently available.</p>
        <div class="property-grid">
            @foreach($properties as $property)
            <div class="property-card">
                <img src="{{ $property->images ? asset('storage/' . $property->images) : asset('images/placeholder.jpg') }}" alt="Property Image" class="property-image">
                <div class="property-details">
                    <h3>{{ $property->title }}</h3>
                    <p>{{ Str::limit($property->description, 100) }}</p>
                    <div class="property-actions">
                        <button type="button" class="btn btn-save" onclick="showDetails('property-details-{{ $property->id }}')">View Details</button>
                        <a href="{{ route('property.edit', $property) }}"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="action-icon"></a>
                        <form action="{{ route('property.destroy', $property) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" style="border:none;background:none;padding:0;cursor:pointer;"><img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="action-icon"></button>
                        </form>
                    </div>
                </div>
                <div id="property-details-{{ $property->id }}" style="display:none;">
                    <h3>Property Details</h3>
                    <ul>
                        <li><strong>Name:</strong> {{ $property->title }}</li>
                        <li><strong>Type:</strong> {{ $property->type }}</li>
                        <li><strong>Status:</strong> {{ $property->status }}</li>
                        <li><strong>Bedrooms:</strong> {{ $property->bedrooms }}</li>
                        <li><strong>Bathrooms:</strong> {{ $property->bathrooms }}</li>
                        <li><strong>Square Feet:</strong> {{ $property->square_feet }}</li>
                        <li><strong>Address:</strong> {{ $property->address }}</li>
                        <li><strong>Features:</strong> {{ $property->features }}</li>
                        <li><strong>Price:</strong> {{ $property->price }}</li>
                        <li><strong>Description:</strong> {{ $property->description }}</li>
                        <li><strong>Created At:</strong> {{ $property->created_at ?? '' }}</li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        <div class="form-actions-center"><a href="{{ route('property.list') }}" class="btn btn-cancel">See More</a></div>
    </div>
</div>
<!-- Modal for Viewing Details -->
<div id="details-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDetails()">&times;</span>
        <div id="details-content"></div>
    </div>
</div>
@push('scripts')
<script>
    function showDetails(detailId) {
        document.getElementById('details-modal').style.display = 'block';
        document.getElementById('details-content').innerHTML = document.getElementById(detailId).innerHTML;
    }

    function closeDetails() {
        document.getElementById('details-modal').style.display = 'none';
    }
</script>
@endpush
@endsection