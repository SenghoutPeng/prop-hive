@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Manage Your Tenants</h1>
        <a href="{{ route('tenant.create') }}" class="btn btn-save" style="margin-top: 15px; margin-bottom: 30px; display: inline-block;">Add New Tenant</a>
    </div>
    <div class="list-container">
        <h2>Current Tenants</h2>
        <p>List of all active tenants in your properties</p>
         @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($properties as $property)
            @if($property->tenant)
            <div class="tenant-item">
                <div class="tenant-info">
                    <img src="{{ asset('images/avatar.png') }}" class="tenant-avatar" alt="avatar">
                    <div>
                        <p class="tenant-name">{{ $property->tenant->user_name ?? 'N/A' }}</p>
                        <p class="tenant-apartment">{{ $property->title }}</p>
                    </div>
                </div>
                <div class="tenant-lease">
                    <!-- Lease info can be added here if you have it -->
                </div>
                <div class="transaction-actions">
                    <button type="button" class="btn btn-save" onclick="showDetails('tenant-details-{{ $property->id }}')">View Details</button>
                    <a href="{{ route('tenant.edit', $property->tenant->user_id) }}"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="action-icon"></a>
                    <form action="{{ route('tenant.destroy', $property->tenant->user_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="border:none; background:none; cursor:pointer; padding:0;">
                            <img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="action-icon">
                        </button>
                    </form>
                </div>
                <div id="tenant-details-{{ $property->id }}" style="display:none;">
                    <h3>Tenant Details</h3>
                    <ul>
                        <li><strong>Name:</strong> {{ $property->tenant->user_name }}</li>
                        <li><strong>Email:</strong> {{ $property->tenant->user_email }}</li>
                        <li><strong>Phone:</strong> {{ $property->tenant->user_phone }}</li>
                        <li><strong>Property:</strong> {{ $property->title }}</li>
                    </ul>
                </div>
            </div>
            @endif
        @endforeach
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