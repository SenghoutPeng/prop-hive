@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Support Ticket Management</h1>
        <p>View and manage all support tickets submitted by users.</p>
    </div>
    <div class="list-container">
        <h2>Support Tickets</h2>
        <p>Overview of all support tickets in the system.</p>
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($tickets as $ticket)
        <div class="tenant-item">
            <div class="tenant-info">
                <img src="{{ asset('images/avatar.png') }}" class="tenant-avatar" alt="User Avatar">
                <div>
                    <p class="tenant-name">{{ $ticket->user_email ?? 'N/A' }}</p>
                    <p class="tenant-apartment">Subject: {{ $ticket->support_ticket_subject }}</p>
                </div>
            </div>
            <div class="tenant-lease">
                Status: <strong>{{ $ticket->support_ticket_status }}</strong><br>
                Created: {{ $ticket->support_ticket_created_at }}<br>
                Responded: {{ $ticket->support_ticket_responded_at ?? 'N/A' }}
            </div>
            <div class="transaction-actions">
                <button type="button" class="btn btn-save" onclick="showDetails('ticket-details-{{ $ticket->support_ticket_id }}')">View Details</button>
                <a href="{{ route('ticket.edit', $ticket->support_ticket_id) }}"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="action-icon"></a>
                <form action="{{ route('ticket.destroy', $ticket->support_ticket_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" style="border:none; background:none; cursor:pointer; padding:0;">
                        <img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="action-icon">
                    </button>
                </form>
            </div>
            <div id="ticket-details-{{ $ticket->support_ticket_id }}" style="display:none;">
                <h3>Ticket Details</h3>
                <ul>
                    <li><strong>User Email:</strong> {{ $ticket->user_email }}</li>
                    <li><strong>Subject:</strong> {{ $ticket->support_ticket_subject }}</li>
                    <li><strong>Message:</strong> {{ $ticket->support_ticket_message }}</li>
                    <li><strong>Status:</strong> {{ $ticket->support_ticket_status }}</li>
                    <li><strong>Created At:</strong> {{ $ticket->support_ticket_created_at }}</li>
                    <li><strong>Responded At:</strong> {{ $ticket->support_ticket_responded_at ?? 'N/A' }}</li>
                </ul>
            </div>
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