@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Property Request Management</h1>
        <p>View and manage property requests from the contact form.</p>
    </div>
    <div class="list-container">
        <h2>Property Requests</h2>
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($contacts as $contact)
        <div class="ticket-item">
            <div class="tenant-info">
                <img src="{{ asset('images/avatar.png') }}" class="tenant-avatar" alt="User Avatar">
                <div>
                    <p class="tenant-name">{{ $contact->name ?? 'N/A' }}</p>
                    <p class="tenant-apartment">Subject: {{ $contact->subject }}</p>
                </div>
            </div>
            <div class="tenant-lease">
                Status: <strong>{{ $contact->status }}</strong><br>
                Created: {{ $contact->created_at }}<br>
                Replied: {{ $contact->replied_at ?? 'N/A' }}
            </div>
            <div class="transaction-actions">
                <button type="button" class="btn btn-save" onclick="showDetails('contact-details-{{ $contact->id }}')">View Details</button>
                <a href="{{ route('contact.edit', $contact->id) }}"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="action-icon"></a>
                <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" style="border:none; background:none; cursor:pointer; padding:0;">
                        <img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="action-icon">
                    </button>
                </form>
            </div>
            <div id="contact-details-{{ $contact->id }}" style="display:none;">
                <h3>Property Request Details</h3>
                <ul>
                    <li><strong>Name:</strong> {{ $contact->name }}</li>
                    <li><strong>Email:</strong> {{ $contact->email }}</li>
                    <li><strong>Subject:</strong> {{ $contact->subject }}</li>
                    <li><strong>Message:</strong> {{ $contact->message }}</li>
                    <li><strong>Status:</strong> {{ $contact->status }}</li>
                    <li><strong>Assigned To:</strong> {{ $contact->assigned_to }}</li>
                    <li><strong>Read At:</strong> {{ $contact->read_at }}</li>
                    <li><strong>Replied At:</strong> {{ $contact->replied_at }}</li>
                    <li><strong>Created At:</strong> {{ $contact->created_at }}</li>
                    <li><strong>Updated At:</strong> {{ $contact->updated_at }}</li>
                </ul>
            </div>
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