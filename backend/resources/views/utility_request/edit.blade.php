@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('utility-request.index') }}" class="back-button">&#x2190;</a>
        <h1>Edit Utility Request #{{ $utilityRequest->utility_request_id }}</h1>
    </div>
    <div class="form-card-full">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        <form action="{{ route('utility-request.update', $utilityRequest->utility_request_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group"><label>User</label><select name="user_id">@foreach($users as $user)<option value="{{ $user->user_id }}" @if($user->user_id == $utilityRequest->user_id) selected @endif>{{ $user->user_name }}</option>@endforeach</select></div>
            <div class="form-group"><label>Property</label><select name="property_id">@foreach($properties as $property)<option value="{{ $property->id }}" @if($property->id == $utilityRequest->property_id) selected @endif>{{ $property->title }}</option>@endforeach</select></div>
            <div class="form-group"><label>Description</label><textarea name="utility_request_description" rows="3">{{ old('utility_request_description', $utilityRequest->utility_request_description) }}</textarea></div>
            <div class="form-group"><label>Status</label><input type="text" name="utility_request_status" value="{{ old('utility_request_status', $utilityRequest->utility_request_status) }}"></div>
            <div class="form-actions-center"><button type="submit" class="btn btn-save">Save Changes</button></div>
        </form>
    </div>
</div>
@endsection 