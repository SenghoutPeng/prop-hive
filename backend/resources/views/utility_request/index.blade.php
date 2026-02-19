@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Utility Request Management</h1>
    </div>
    <div class="list-container">
        <h2>Utility Requests</h2>
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        @foreach($utilityRequests as $request)
            <div class="ticket-item">
                <div class="tenant-info">
                    <img src="{{ asset('images/avatar.png') }}" class="tenant-avatar" alt="User Avatar">
                    <div>
                        <p class="tenant-name">{{ $request->user ? $request->user->user_name : 'N/A' }}</p>
                        <p class="tenant-apartment">
                            Property: {{ $request->property ? $request->property->title : $request->property_id }}<br>
                            <span style="color: #6c757d;">{{ $request->utility_request_description }}</span>
                        </p>
                    </div>
                </div>
                <div class="tenant-lease">
                    Status: <strong>{{ $request->utility_request_status }}</strong><br>
                    Created: {{ $request->utility_request_created_at }}<br>
                    @if($request->utility_request_responded_at)
                        Replied: {{ $request->utility_request_responded_at }}
                    @endif
                </div>
                <div class="transaction-actions">
                    <button type="button" class="btn btn-save" onclick="showDetails('utility-details-{{ $request->utility_request_id }}')">View Details</button>
                    <a href="{{ route('utility-request.edit', $request->utility_request_id) }}">
                        <img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="action-icon">
                    </a>
                    <form action="{{ route('utility-request.destroy', $request->utility_request_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="border:none; background:none; cursor:pointer; padding:0;">
                            <img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="action-icon">
                        </button>
                    </form>
                </div>
            </div>
            <div id="utility-details-{{ $request->utility_request_id }}" style="display:none;">
                <h3>Utility Request Details</h3>
                <ul>
                    <li><strong>ID:</strong> {{ $request->utility_request_id }}</li>
                    <li><strong>User:</strong> {{ $request->user ? $request->user->user_name : $request->user_id }}</li>
                    <li><strong>Property:</strong> {{ $request->property ? $request->property->title : $request->property_id }}</li>
                    <li><strong>Description:</strong> {{ $request->utility_request_description }}</li>
                    <li><strong>Status:</strong> {{ $request->utility_request_status }}</li>
                    <li><strong>Created At:</strong> {{ $request->utility_request_created_at }}</li>
                    <li><strong>Responded At:</strong> {{ $request->utility_request_responded_at ?? 'N/A' }}</li>
                </ul>
            </div>
        @endforeach
    </div>
</div>
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